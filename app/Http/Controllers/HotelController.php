<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmadeusService;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function listHotelsByCity(Request $request)
    {
        $cityCode = $request->input('cityCode');
        $radius = $request->input('radius', 5);
        $radiusUnit = $request->input('radiusUnit', 'KM');
        $hotelSource = $request->input('hotelSource', 'ALL');

        $hotels = $this->amadeusService->searchHotelsByCity($cityCode, $radius, $radiusUnit, $hotelSource);

        if (isset($hotels['error'])) {
            // Handle the error gracefully in the view
            return view('hotels.results', ['error' => $hotels['message']]);
        }

        // Manually paginate the results
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = array_slice($hotels['data'], ($currentPage - 1) * $perPage, $perPage);
        $paginatedHotels = new LengthAwarePaginator($currentItems, count($hotels['data']), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => $request->query(), // Keep query parameters for pagination links
        ]);

        return view('hotels.results', [
            'hotels' => $paginatedHotels,
            'cityCode' => $cityCode,
            'radius' => $radius,
            'radiusUnit' => $radiusUnit,
            'hotelSource' => $hotelSource
        ]);
    }

    public function showSearchForm()
    {
        return view('hotels.search');
    }
}
