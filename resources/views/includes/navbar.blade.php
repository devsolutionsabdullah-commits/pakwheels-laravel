<nav>
    <a href="{{ route('home') }}">PakWheels</a>
    @auth
        <a href="{{ route('car-ads.create') }}">Post Ad</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>