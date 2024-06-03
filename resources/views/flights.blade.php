<!-- resources/views/travel/flights.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights</title>
</head>
<body>
    <h1>Available Flights</h1>
    <table>
        <thead>
            <tr>
                <th>Airline</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flights['data'] as $flight)
                @php
                    $isNonStop = count($flight['itineraries'][0]['segments']) === 1;
                @endphp
                @if(!$nonStop || ($nonStop && $isNonStop))
                    <tr>
                        <td>{{ $airlineNames[$flight['itineraries'][0]['segments'][0]['carrierCode']] ?? $flight['itineraries'][0]['segments'][0]['carrierCode'] }}</td>
                        <td>{{ $flight['itineraries'][0]['segments'][0]['departure']['iataCode'] }} ({{ $flight['itineraries'][0]['segments'][0]['departure']['at'] }})</td>
                        <td>{{ $flight['itineraries'][0]['segments'][0]['arrival']['iataCode'] }} ({{ $flight['itineraries'][0]['segments'][0]['arrival']['at'] }})</td>
                        <td>{{ $flight['price']['total'] }} {{ $flight['price']['currency'] }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
