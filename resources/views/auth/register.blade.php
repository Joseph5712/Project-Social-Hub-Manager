<!-- resources/views/auth/register.blade.php -->
<link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
    <button type="submit">Registrarse</button>
</form>
