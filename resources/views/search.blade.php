<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search - PakWheels</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('includes.navbar')

    <h1>Search Vehicles</h1>

    <form method="GET" action="{{ route('search') }}">
        <input type="text" name="query" value="{{ $query }}" placeholder="Search cars, bikes...">
        <select name="type">
            <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All</option>
            <option value="car" {{ $type == 'car' ? 'selected' : '' }}>Cars</option>
            <option value="bike" {{ $type == 'bike' ? 'selected' : '' }}>Bikes</option>
        </select>
        <button type="submit">Search</button>
    </form>

    {{-- Car Results --}}
    @if($car_results->count() > 0)
        <h2>Cars</h2>
        @foreach($car_results as $car)
            <div>
                <img src="{{ asset('storage/'.$car->image_1) }}" width="150">
                <h3>{{ $car->car_info }}</h3>
                <p>Rs. {{ number_format($car->price) }}</p>
                <p>{{ $car->city }}</p>
                <a href="{{ route('car-ads.show', $car->id) }}">View Details</a>
            </div>
        @endforeach
    @endif

    {{-- Bike Results --}}
    @if($bike_results->count() > 0)
        <h2>Bikes</h2>
        @foreach($bike_results as $bike)
            <div>
                <img src="{{ asset('storage/'.$bike->image_1) }}" width="150">
                <h3>{{ $bike->bike_info }}</h3>
                <p>Rs. {{ number_format($bike->price) }}</p>
                <p>{{ $bike->city }}</p>
                <a href="{{ route('bike-ads.show', $bike->id) }}">View Details</a>
            </div>
        @endforeach
    @endif

    {{-- No Results --}}
    @if($car_results->count() == 0 && $bike_results->count() == 0)
        <p>No results found for "{{ $query }}"</p>
    @endif

    @include('includes.footer')
</body>
</html>