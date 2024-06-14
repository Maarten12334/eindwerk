<!-- resources/views/itineraries/pdf.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>{{ $itinerary->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h4 {
            margin-bottom: 10px;
        }

        .section p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $itinerary->name }}</h1>
        <p>{{ $start_date }} - {{ $end_date }}</p>
    </div>

    <div class="section">
        <h2>Hotels</h2>
        @foreach ($hotels as $hotel)
        <h3>{{ $hotel->name }}</h3>
        <p>(Check-in: {{ $hotel->arrival }} - Check-out:{{ $hotel->departure }})</p>
        <p>Address: {{$hotel->address}}</p>
        @endforeach
    </div>

    <div class="section">
        <h4>Itinerary Items</h4>
        @foreach ($items_by_date as $date => $items)
        <h5>{{ $date }}</h5>
        @foreach ($items as $item)
        <p>{{ $item['type'] }}: {{ \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i') }}</p>
        @endforeach
        @endforeach
    </div>
</body>

</html>