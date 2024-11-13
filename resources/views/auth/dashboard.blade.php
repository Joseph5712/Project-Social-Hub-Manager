<!-- resources/views/dashboard.blade.php -->
<link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

<h1>Bienvenido al Dashboard</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
