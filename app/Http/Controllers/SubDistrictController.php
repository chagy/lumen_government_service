<?php

namespace App\Http\Controllers;

use App\Models\SubDistrict;
use Illuminate\Http\Request;
use App\Http\Resources\SubDistrictResource;

class SubDistrictController extends Controller
{
    public function index() {
        $subDistricts = SubDistrict::paginate(20);

        return response()->json([
            'success' => true,
            'data' => SubDistrictResource::collection($subDistricts)->response()->getData(true)
        ]);
    }
}
