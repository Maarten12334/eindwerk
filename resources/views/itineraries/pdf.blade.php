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
            background-color: #f9fafb;
            color: #374151;
        }

        .container {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #34d399;
            color: white;
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
            background-color: #f3f4f6;
        }

        .items-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="text-3xl font-bold">{{ $itinerary->name }}</h1>
            <p class="text-lg">{{ $start_date->format('d-m-Y') }} - {{ $end_date->format('d-m-Y') }}</p>
        </div>

        @foreach ($items_by_date as $date => $items)
        <div class="section @if(!$loop->first) page-break @endif">
            <h4 class="text-2xl font-semibold mb-4">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h4>

            @foreach ($hotels as $hotel)
            @if (\Carbon\Carbon::parse($hotel->arrival)->lte(\Carbon\Carbon::parse($date)) && \Carbon\Carbon::parse($hotel->departure)->gte(\Carbon\Carbon::parse($date)))
            <div class="mb-4">
                <h3 class="text-xl font-medium">{{ $hotel->name }}</h3>
                <p class="text-gray-600">Check-in: {{ \Carbon\Carbon::parse($hotel->arrival)->format('d-m-Y') }} - Check-out: {{ \Carbon\Carbon::parse($hotel->departure)->format('d-m-Y') }}</p>
                <p class="text-gray-600">Address: {{ $hotel->address }}</p>
            </div>
            @endif
            @endforeach

            <table class="items-table w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 bg-gray-200">Type</th>
                        <th class="border px-4 py-2 bg-gray-200">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (collect($items)->sortBy('time') as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item['type'] }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::createFromFormat('H:i:s', $item['time'])->format('H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</body>

</html>