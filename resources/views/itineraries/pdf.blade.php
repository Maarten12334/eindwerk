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

        .date-header {
            padding: 10px;
            background-color: #283A2C;
            color: #DADDC5;
            border-radius: 8px;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
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

        hr {
            border: 0;
            height: 1px;
            background: #DADDC5;
            margin: 20px 0;
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

    @php
    $current_date = $start_date->copy();
    @endphp
    @while ($current_date->lte($end_date))
    @php
    $dateFormatted = $current_date->format('d-m-Y');
    $items = $items_by_date[$current_date->toDateString()] ?? [];
    $isLastDay = $current_date->isSameDay($end_date);
    @endphp
    <div class="section @if(!$current_date->isSameDay($start_date)) page-break @endif">
        <div class="date-header">{{ $dateFormatted }}</div>

        @if(count($items) > 0)
        @foreach (collect($items)->sortBy('time') as $item)
        <div class="item-entry">
            <p class="item-type">{{ $item['type'] }} <span class="item-time">{{ \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i') }}</span></p>
        </div>
        @endforeach
        @else
        <p class="text-center text-gray-500"></p>
        @endif

        @if(!$isLastDay)
        <hr>
        @endif
    </div>
    @php
    $current_date->addDay();
    @endphp
    @endwhile

    <div class="qr-code text-center mt-6">
        <h2 class="text-2xl font-semibold mb-4">Scan de QR code om uw reisplan online te zien:</h2>
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
        <p class="mt-2 text-lg">Of deel deze link met uw vrienden/familie:</p>
        <p class=" text-lg"><a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
    </div>
</body>

</html>