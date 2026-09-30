<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    @vite(['resources/css/game.css', 'resources/css/dashboard.css'])
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="logo">
            MY<span>GAME</span>
        </div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('game') }}">Play</a>
            <a href="{{ route('cars.select') }}">Garage</a>
        </div>

        <div class="profile">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span>{{ Auth::user()->name }}</span>
            <a href="{{ route('profile.edit') }}" class="nav-action">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="nav-action">Log out</button>
            </form>
        </div>

    </nav>


    <!-- DASHBOARD AREA -->
    <main class="dash-page">

        <!-- WELCOME BANNER -->
        <div class="dash-hero">
            <div>
                <h1>Welcome back, {{ Auth::user()->name }} 👋</h1>
                <p>Ready to hit the track?</p>
            </div>
            <span class="date">{{ now()->format('l, d M Y') }}</span>
        </div>

        @if (session('status'))
            <div class="cars-status">{{ session('status') }}</div>
        @endif

        <!-- GARAGE STATUS -->
        <div class="garage-status">
            @if ($selectedCar)
                <div class="car-info">
                    <span class="swatch" style="background: {{ $selectedCar->color }}; box-shadow: 0 0 14px {{ $selectedCar->color }};"></span>
                    <div>
                        <span class="label">CURRENTLY DRIVING</span>
                        <strong style="color: {{ $selectedCar->color }}">{{ $selectedCar->name() }}</strong>
                    </div>
                </div>
                <a href="{{ route('cars.select') }}" class="btn btn-outline">CHANGE CAR</a>
            @else
                <span class="empty">You haven't picked a car yet.</span>
                <a href="{{ route('cars.select') }}" class="btn">CHOOSE YOUR CAR</a>
            @endif
        </div>

        <!-- QUICK ACTIONS -->
        <div class="dash-grid">

            <a href="{{ route('game') }}" class="dash-card">
                <span class="icon">▶</span>
                <h3>Play the Game</h3>
                <p>Jump straight onto the track and start racing.</p>
            </a>

            <a href="{{ route('cars.select') }}" class="dash-card">
                <span class="icon">🏎</span>
                <h3>Garage</h3>
                <p>Browse every brand & model and pick your ride.</p>
            </a>

            <a href="{{ route('profile.edit') }}" class="dash-card">
                <span class="icon">⚙</span>
                <h3>Account Settings</h3>
                <p>Update your name, email and password.</p>
            </a>

        </div>

    </main>

</body>
</html>
