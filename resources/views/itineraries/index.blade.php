<x-app-layout>
    <x-slot name="header">
        <div class="bg-primaryGreen py-6 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-secondaryGreen leading-tight">
                    {{ __('Reizen') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-16 relative bg-cover bg-center" style="background-image: url('{{ asset('images/map.jpg') }}')">
        <div class="container mx-auto p-6 relative bg-primaryGreen bg-opacity-90 rounded shadow-lg mb-8 text-secondaryGreen dark:text-gray-100">
            <h4 class="mb-4 text-xl">Mijn reizen</h4>
            @if ($itineraries->isEmpty())
            <p>No itineraries found.</p>
            @else
            <table class="min-w-full bg-primaryGreen dark:bg-gray-800 bg-opacity-90 mb-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Naam</th>
                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Vertrekdatum</th>
                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Retourdatum</th>
                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700t">Vlucht ID</th>
                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itineraries as $itinerary)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('itineraries.show', $itinerary->id) }}" class="text-blue-500 hover:underline">
                                {{ $itinerary->name }}
                            </a>
                        </td>
                        <td class="py-2 px-4 text-center">{{ $itinerary->departure }}</td>
                        <td class="py-2 px-4 text-center">{{ $itinerary->return }}</td>
                        <td class="py-2 px-4 text-center">{{ $itinerary->flight_id }}</td>
                        <td class="py-2 px-4 flex items-center space-x-4">
                            <a href="{{ route('itineraries.edit', $itinerary->id) }}" class="text-yellow-500 hover:underline">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('itineraries.destroy', $itinerary->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit reisschema wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <div class="text-right">
                <a href="{{ route('itineraries.create') }}">
                    <button class="btn btn-primary bg-oliveGreen text-white py-2 px-4 rounded">Maak een nieuw schema</button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>