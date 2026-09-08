<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Game</title>

    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="logo">
            MY<span>GAME</span>
        </div>

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Play</a>
            <a href="#">Shop</a>
            <a href="#">Leaderboard</a>
        </div>

        <div class="profile">
            <div class="avatar">P</div>
            <span>Player</span>
        </div>

    </nav> //_static_cast


    <!-- GAME AREA -->
    <main class="game-page">

        <div class="game-header">
            <div>
                <h1>Game name</h1>
                <p>Game description</p>
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


    <script src="{{ asset('js/game.js') }}"></script>

</body>
</html>