<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZoneResource;
use App\Models\Country;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZonesByCountryController extends Controller
{
    public function __invoke(Country $country)
    {
        $zones = Zone::whereHas('country', function($q) use ($country) {
            $q->where('id', $country->id);
        })->with('country')->get();

        return ZoneResource::collection($zones);
    }
}
