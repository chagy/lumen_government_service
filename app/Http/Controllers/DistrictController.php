<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Resources\DistrictResource;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function index() {
        $districts = District::paginate(20);

        return response()->json([
            'success' => true,
            'data' => DistrictResource::collection($districts)->response()->getData(true)
        ]);
    }

    public function show($district) {
        $district = District::findOrFail($district);

        return response()->json([
            'success' => true,
            'data' => new DistrictResource($district)
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'province_id' => 'required|integer',
            'dist_name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ],401);
        }

        $district = District::create([
            'province_id' => $request->province_id,
            'dist_name' => $request->dist_name,
            'dist_desc' => $request->dist_desc
        ]);

        return response()->json([
            'success' => true,
            'data' => new DistrictResource($district)
        ]);
    }

    public function update(Request $request, $district) {
        $district = District::findOrFail($district);

        $validator = Validator::make($request->all(),[
            'province_id' => 'required|integer',
            'dist_name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ],401);
        }

        $district->update([
            'province_id' => $request->province_id,
            'dist_name' => $request->dist_name,
            'dist_desc' => $request->dist_desc
        ]);

        return response()->json([
            'success' => true,
            'data' => new DistrictResource($district)
        ]);
    }

    public function destroy($district) {
        $district = District::findOrFail($district);
        $district->delete();

        return response()->json([
            'success' => true,
            'message' => '???????????????????????????????????????????????????'
        ],204);
    }

    public function restore($district) {
        $district = District::onlyTrashed()->findOrFail($district);
        $district->restore();

        return response()->json([
            'success' => true,
            'message' => '??????????????????????????????????????????????????????'
        ],204);
    }

    public function forceDelete($district) {
        $district = District::onlyTrashed()->findOrFail($district);
        $district->forceDelete();

        return response()->json([
            'success' => true,
            'message' => '???????????????????????????????????????????????????'
        ],204);
    }
}
