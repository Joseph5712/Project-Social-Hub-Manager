<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
//use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\QRCode\Bacon;
use PragmaRX\Google2FAQRCode\Google2FA;


class AuthController extends Controller
{
    // Muestra el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Manejador del registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Cuenta creada exitosamente.');
    }

    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejador de inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->google2fa_secret && !session('2fa_verified')) {
                return redirect()->route('enablefa');  // Redirige al formulario de 2FA
            }
            return redirect()->intended('/dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        throw ValidationException::withMessages([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Manejador de cierre de sesión
    public function logout(Request $request)
{
    // Eliminar el estado de 2FA de la sesión
    $request->session()->forget('2fa_verified');
    
    // Realizar logout
    Auth::logout();
    
    // Redirigir a la página de login
    return redirect()->route('login')->with('success', 'Sesión cerrada.');
}


    public function enable2FA(Request $request)
{
    $google2fa = new Google2FA();
    $userId = Auth::id();  // Obtener el ID del usuario autenticado

    // Generar un secreto único para el usuario
    $secret = $google2fa->generateSecretKey();
    //$google2fa->setAllowInsecureCallToGoogleApis(true);

    //dd($secret);  // Verifica que el $secret no esté vacío

    // Obtener el usuario autenticado
    

    // Usar updateOrInsert para guardar o actualizar el secreto de Google2FA
    DB::table('users')->updateOrInsert(
        ['id' => $userId],  // Condición de búsqueda (usuario por ID)
        ['google2fa_secret' => $secret]  // El campo que queremos actualizar
    );
    $google2fa->setQrCodeService(new Bacon());
    
    // Generar un QR Code para Google Authenticator
    $QRImage = $google2fa->getQRCodeInline(
        config('app.name'),  // Nombre de la app
        Auth::user()->email, // Correo del usuario
        $secret              // Secreto generado
    );
    //dd($QRImage);
    
    return view('auth.enable2fa', [
        'QRImage' => $QRImage,
        'secret' => $secret,
    ]);
}

public function verify2FA(Request $request)
{
    $google2fa = new Google2FA();

    $user = Auth::user();  // Obtener al usuario autenticado

    // Verificar si el código OTP ingresado es válido
    $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('otp'));
    //dd($user->google2fa_secret);  // Verifica si se ha guardado correctamente el secreto


    if ($valid) {
        // Guardar en sesión que el 2FA ha sido verificado
        $request->session()->put('2fa_verified', true);
        
        return redirect()->route('dashboard')->with('success', '2FA activado con éxito.');
    } else {
        return back()->withErrors(['error' => 'El código OTP es inválido.']);
    }
}

}
