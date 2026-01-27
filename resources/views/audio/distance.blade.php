<form method="POST" action="{{ route('distance.calc') }}">
    @csrf
    <input type="text" name="lat1" placeholder="Latitude 1" required>
    <input type="text" name="lng1" placeholder="Longitude 1" required>

    <input type="text" name="lat2" placeholder="Latitude 2" required>
    <input type="text" name="lng2" placeholder="Longitude 2" required>

    <button type="submit">Calculate Distance</button>
</form>

@if(isset($distance))
<h2>Distance: {{ $distance }} KM</h2>
@endif
