<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Game</title>

    @vite(['resources/css/game.css', 'resources/js/game.js'])
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


    <!-- GAME AREA -->
    <main class="game-page">

        <div class="game-header">
            <div>
                <h1>Game name</h1>
                @if ($selectedCar)
                    <p>Driving the <strong style="color: {{ $selectedCar->color }}">{{ $selectedCar->name() }}</strong> &middot; <a href="{{ route('cars.select') }}" style="color:#9d4edd;">change car</a></p>
                @else
                    <p><a href="{{ route('cars.select') }}" style="color:#9d4edd;">Choose a car</a> before you race!</p>
                @endif
            </div>

            <div class="game-status">
                <span class="status-dot"></span>
            </div>
        </div>


        <!-- GAME -->
        <div class="game-container">

            <canvas id="gameCanvas" width="900" height="550"></canvas>

            <div class="game-overlay">
                <span>Control explained</span>
                <span>Control explained</span>
            </div>

        </div>


        <!-- GAME CONTROLS -->
            <button id="startGame">
                START GAME
            </button>

            <div class="score">
                <span class="label">SCORE</span>
                <strong id="score">000000</strong> <!-- Wat willen jullie hier?-->
            </div>

        </div>

    </main>

    @php
        $playerCar = $selectedCar ? [
            'name' => $selectedCar->name(),
            'color' => $selectedCar->color,
            'speed_rating' => $selectedCar->speed_rating,
        ] : null;
    @endphp

    <script>
        window.PLAYER_CAR = @json($playerCar);
    </script>

</body>
</html>