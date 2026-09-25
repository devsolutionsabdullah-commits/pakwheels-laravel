<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PakWheels - Buy & Sell Cars & Bikes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Navbar --}}
    @include('includes.navbar')

    {{-- Hero Section --}}
    <div class="hero">
        <h1>Buy & Sell Cars and Bikes</h1>
        <p>Total Cars: {{ $total_cars }} | Total Bikes: {{ $total_bikes }}</p>
    </div>

    {{-- New Bikes --}}
    <section>
        <h2>New Bikes</h2>
        <div class="ads-grid">
            @forelse($new_bikes as $bike)
                <div class="ad-card">
                    <img src="{{ asset($bike->image_1) }}" alt="bike">
                    <h3>{{ $bike->bike_info }}</h3>
                    <p>Rs. {{ number_format($bike->price) }}</p>
                    <p>{{ $bike->city }}</p>
                    <a href="{{ route('bike-ads.show', $bike->id) }}">View Details</a>
                </div>
            @empty
                <p>No new bikes available</p>
            @endforelse
        </div>
    </section>

    {{-- Used Bikes --}}
    <section>
        <h2>Used Bikes</h2>
        <div class="ads-grid">
            @forelse($used_bikes as $bike)
                <div class="ad-card">
                    <img src="{{ asset($bike->image_1) }}" alt="bike">
                    <h3>{{ $bike->bike_info }}</h3>
                    <p>Rs. {{ number_format($bike->price) }}</p>
                    <p>{{ $bike->city }}</p>
                    <a href="{{ route('bike-ads.show', $bike->id) }}">View Details</a>
                </div>
            @empty
                <p>No used bikes available</p>
            @endforelse
        </div>
    </section>

    {{-- New Cars --}}
    <section>
        <h2>New Cars</h2>
        <div class="ads-grid">
            @forelse($new_cars as $car)
                <div class="ad-card">
                    <img src="{{ asset($car->image_1) }}" alt="car">
                    <h3>{{ $car->car_info }}</h3>
                    <p>Rs. {{ number_format($car->price) }}</p>
                    <p>{{ $car->city }}</p>
                    <a href="{{ route('car-ads.show', $car->id) }}">View Details</a>
                </div>
            @empty
                <p>No new cars available</p>
            @endforelse
        </div>
    </section>

    {{-- Used Cars --}}
    <section>
        <h2>Used Cars</h2>
        <div class="ads-grid">
            @forelse($used_cars as $car)
                <div class="ad-card">
                    <img src="{{ asset($car->image_1) }}" alt="car">
                    <h3>{{ $car->car_info }}</h3>
                    <p>Rs. {{ number_format($car->price) }}</p>
                    <p>{{ $car->city }}</p>
                    <a href="{{ route('car-ads.show', $car->id) }}">View Details</a>
                </div>
            @empty
                <p>No used cars available</p>
            @endforelse
        </div>
    </section>

    {{-- Footer --}}
    @include('includes.footer')

</body>
</html>