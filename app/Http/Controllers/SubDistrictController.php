<?php

namespace App\Http\Controllers;

use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function show($sub_district) {
        $sub_district = SubDistrict::findOrFail($sub_district);

        return response()->json([
            'success' => true,
            'data' => new SubDistrictResource($sub_district)
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'district_id' => 'required|integer',
            'subd_name' => 'required',
            'subd_desc' => 'nullable',
            'subd_zipcode' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $sub_district = SubDistrict::create([
            'district_id' => $request->district_id,
            'subd_name' => $request->subd_name,
            'subd_desc' => $request->subd_desc,
            'subd_zipcode' => $request->subd_zipcode
        ]);

        return response()->json([
            'success' => true,
            'data' => new SubDistrictResource($sub_district)
        ]);
    }

    public function update(Request $request,$sub_district) {
        $sub_district = SubDistrict::findOrFail($sub_district);

        $validator = Validator::make($request->all(),[
            'district_id' => 'required|integer',
            'subd_name' => 'required',
            'subd_desc' => 'nullable',
            'subd_zipcode' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $sub_district->update([
            'district_id' => $request->district_id,
            'subd_name' => $request->subd_name,
            'subd_desc' => $request->subd_desc,
            'subd_zipcode' => $request->subd_zipcode
        ]);

        return response()->json([
            'success' => true,
            'data' => new SubDistrictResource($sub_district)
        ]);
    }

    public function destroy($sub_district) {
        $sub_district = SubDistrict::findOrFail($sub_district);
        $sub_district->delete();

        return response()->json([
            'success' => true,
            'message' => 'ลบข้อมูลเรียบร้อย'
        ],204);
    }
}
