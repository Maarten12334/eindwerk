<!DOCTYPE html>
<html>

<head>
    <title>{{ $itinerary->name }}</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');

        @media print {
            .page-break {
                page-break-before: always;
            }
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F1EFEC;
            color: #283A2C;
        }

        .container {
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #283A2C;
            color: #FFFFFF;
            border-radius: 8px;
        }

        .section {
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #e5e7eb;
        }

        .items-table th {
            background-color: #DADDC5;
        }

        .items-table tr:nth-child(even) {
            background-color: #F1EFEC;
        }

        .hotels-list {
            margin-bottom: 30px;
        }

        .hotel-item {
            margin-bottom: 10px;
        }

        .hotel-item h3 {
            color: #808000;
        }

        .items-table {
            display: none;
        }

        .item-entry {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #DADDC5;
            border-radius: 4px;
        }

        .item-entry:nth-child(even) {
            background-color: #F1EFEC;
        }

        .item-type {
            font-weight: bold;
        }

        .item-time {
            font-style: italic;
            color: #808000;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="text-3xl font-bold">{{ $itinerary->name }}</h1>
        <p class="text-lg">{{ $start_date->format('d-m-Y') }} - {{ $end_date->format('d-m-Y') }}</p>
    </div>

    <div class="hotels-list">
        <h2 class="text-2xl font-semibold mb-4">Hotels</h2>
        @foreach ($hotels->sortBy('arrival') as $hotel)
        <div class="hotel-item">
            <h3 class="text-xl font-medium">{{ $hotel->name }}</h3>
            <p class="text-gray-600">Check-in: {{ \Carbon\Carbon::parse($hotel->arrival)->format('d-m-Y') }} - Check-out: {{ \Carbon\Carbon::parse($hotel->departure)->format('d-m-Y') }}</p>
            <p class="text-gray-600">Address: {{ $hotel->address }}</p>
        </div>
        @endforeach
    </div>

    @foreach ($items_by_date as $date => $items)
    <div class="section @if(!$loop->first) page-break @endif">
        <h4 class="text-xl font-semibold mb-4">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h4>

        @foreach (collect($items)->sortBy('time') as $item)
        <div class="item-entry">
            <p class="item-type">{{ $item['type'] }}</p>
            <p class="item-time">{{ \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i') }}</p>
        </div>
        @endforeach
    </div>
    @endforeach
</body>

</html>