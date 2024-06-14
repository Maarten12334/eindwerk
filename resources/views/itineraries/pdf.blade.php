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

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $itinerary->name }}</h1>
        <p>{{ $start_date->format('d-m-Y') }} - {{ $end_date->format('d-m-Y') }}</p>
    </div>

    <div class="section">
        <h2>Hotels</h2>
        @foreach ($hotels as $hotel)
        <h3>{{ $hotel->name }}</h3>
        <p>(Check-in: {{ \Carbon\Carbon::parse($hotel->arrival)->format('d-m-Y') }} - Check-out: {{ \Carbon\Carbon::parse($hotel->departure)->format('d-m-Y') }})</p>
        <p>Address: {{$hotel->address}}</p>
        @endforeach
    </div>

    <div class="section">
        <h4>Itinerary Items</h4>
        @foreach ($items_by_date as $date => $items)
        <h5>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h5>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach (collect($items)->sortBy('time') as $item)
                <tr>
                    <td>{{ $item['type'] }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</body>

</html>