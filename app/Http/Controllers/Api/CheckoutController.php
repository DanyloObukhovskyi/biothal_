<?php

namespace App\Http\Controllers\Api;

use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CheckoutController extends Controller
{
    /**
     * @var NovaPoshtaService
     */
    public NovaPoshtaService $novaPoshtaService;

    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $this->novaPoshtaService = new NovaPoshtaService();
    }

    public function getRegions()
    {
        $regions = $this->novaPoshtaService->getRegions();

        return response()->json($regions);
    }

    public function getRegionCities(Request $request)
    {
        $region = $request->get('region');

        $cities = $this->novaPoshtaService
            ->getRegionCities($region);

        return response()->json($cities);
    }

    public function getPostalOffices(Request $request)
    {
        $city = $request->get('city');

        $postalOffices = $this->novaPoshtaService
            ->getPostalOffices($city);

        return response()->json($postalOffices);
    }
}
