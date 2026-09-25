<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bike Ads</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('includes.navbar')

    <h1>My Bike Ads</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <a href="{{ route('bike-ads.create') }}">Post New Bike Ad</a>

    @forelse($bike_ads as $bike)
        <div>
            <img src="{{ asset('storage/'.$bike->image_1) }}" width="150">
            <h3>{{ $bike->bike_info }}</h3>
            <p>Rs. {{ number_format($bike->price) }}</p>
            <p>{{ $bike->city }}</p>
            <a href="{{ route('bike-ads.show', $bike->id) }}">View</a>
            <a href="{{ route('bike-ads.edit', $bike->id) }}">Edit</a>
            <form method="POST" action="{{ route('bike-ads.destroy', $bike->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @empty
        <p>No bike ads posted yet!</p>
    @endforelse

    @include('includes.footer')
</body>
</html>