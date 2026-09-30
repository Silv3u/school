<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Choose Your Car</title>

    @vite(['resources/css/game.css', 'resources/css/cars.css', 'resources/js/cars.js'])
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


    <!-- CAR SELECT AREA -->
    <main class="cars-page">

        <div class="game-header">
            <div>
                <h1>Choose Your Car</h1>
                
            </div>
        </div>

        @if (session('status'))
            <div class="cars-status">{{ session('status') }}</div>
        @endif

        @if ($selectedCar)
            <div class="current-car">
                Currently driving:
                <strong style="color: {{ $selectedCar->color }}">{{ $selectedCar->name() }}</strong>
            </div>
        @endif

        <form method="POST" action="{{ route('cars.store') }}" class="cars-form" id="carForm">
            @csrf

            <div class="cars-grid">

                <div class="field">
                    <label class="label" for="brand">Brand</label>
                    <select id="brand" class="select">
                        <option value="">Select a brand&hellip;</option>
                        @foreach ($cars as $brand => $models)
                            <option value="{{ $brand }}" @selected($selectedCar?->brand === $brand)>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label class="label" for="model">Model</label>
                    <select id="model" name="car_id" class="select" disabled required>
                        <option value="">Select a brand first&hellip;</option>
                    </select>
                    @error('car_id')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="car-preview" id="carPreview" hidden>
                <span class="swatch" id="carSwatch"></span>
                <div>
                    <strong id="carPreviewName"></strong>
                    <div class="speed-rating">
                        Speed:
                        <span id="carSpeedDots"></span>
                    </div>
                </div>
            </div>

            <button type="submit" id="confirmCar" disabled>
                CONFIRM & RACE
            </button>

        </form>

    </main>

    {{-- Car catalog, grouped by brand, for the cascading dropdown --}}
    <script>
        window.CAR_CATALOG = @json($cars);
        window.SELECTED_CAR_ID = @json($selectedCar?->id);
    </script>

</body>
</html>
