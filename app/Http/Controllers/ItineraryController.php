<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Hotel;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class ItineraryController extends Controller
{
    public function index()
    {
        $itineraries = auth()->user()->itineraries;
        return view('itineraries.index', compact('itineraries'));
    }

    public function create()
    {
        return view('itineraries.create');
    }

    public function addHotel(Request $request, Itinerary $itinerary)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'arrival' => 'required|date',
            'departure' => 'required|date|after_or_equal:arrival',
            'address' => 'required|string|max:255',
        ]);

        Hotel::create([
            'itinerary_id' => $itinerary->id,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'arrival' => $request->input('arrival'),
            'departure' => $request->input('departure'),
        ]);

        return redirect()->route('itineraries.show', $itinerary)->with('success', 'Hotel added to itinerary!');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'departure' => 'required|date',
            'return' => 'required|date|after_or_equal:departure',
            'flight_id' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();
        Itinerary::create($validated);

        return redirect()->route('itineraries.index');
    }

    public function show($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $start_date = Carbon::parse($itinerary->departure);
        $end_date = Carbon::parse($itinerary->return);
        $items_by_date = $itinerary->items()->orderBy('date')->get()->groupBy('date')->toArray();

        return view('itineraries.show', compact('itinerary', 'start_date', 'end_date', 'items_by_date'));
    }

    public function edit($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        return view('itineraries.edit', compact('itinerary'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'departure' => 'required|date',
            'return' => 'required|date|after_or_equal:departure',
            'flight_id' => 'nullable|string|max:255',
        ]);

        $itinerary = Itinerary::findOrFail($id);
        $itinerary->update($validated);

        return redirect()->route('itineraries.index');
    }

    public function destroy($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->delete();

        return redirect()->route('itineraries.index');
    }

    public function downloadPDF(Itinerary $itinerary)
    {
        $start_date = Carbon::parse($itinerary->departure);
        $end_date = Carbon::parse($itinerary->return);
        $items_by_date = $itinerary->items()->orderBy('date')->get()->groupBy('date')->toArray();
        $hotels = $itinerary->hotels; // Retrieve the associated hotels

        // Generate the QR code
        $url = route('itineraries.show', $itinerary->id); // Assuming you have a named route for the itinerary page
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->generate($url));

        // Pass the QR code to the view
        $pdf = Pdf::loadView('itineraries.pdf', compact('itinerary', 'start_date', 'end_date', 'items_by_date', 'hotels', 'qrCode'));
        $fileName = $itinerary->name . '.pdf'; // Create the file name using the itinerary name
        return $pdf->download($fileName);
    }
}
