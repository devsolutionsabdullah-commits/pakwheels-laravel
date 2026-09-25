<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Car Ads</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('includes.navbar')

    <h1>My Car Ads</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <a href="{{ route('car-ads.create') }}">Post New Car Ad</a>

    @forelse($car_ads as $car)
        <div>
            <img src="{{ asset('storage/'.$car->image_1) }}" width="150">
            <h3>{{ $car->car_info }}</h3>
            <p>Rs. {{ number_format($car->price) }}</p>
            <p>{{ $car->city }}</p>
            <a href="{{ route('car-ads.show', $car->id) }}">View</a>
            <a href="{{ route('car-ads.edit', $car->id) }}">Edit</a>
            <form method="POST" action="{{ route('car-ads.destroy', $car->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @empty
        <p>No car ads posted yet!</p>
    @endforelse

    @include('includes.footer')
</body>
</html>