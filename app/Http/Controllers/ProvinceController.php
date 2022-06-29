<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();

        return response()->json([
            'data' => $provinces
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'prov_name' => 'required|unique:provinces',
        ],[
            'prov_name.required' => 'กรุณากรอกชื่อจังหวัด',
            'prov_name.unique' => 'กรุณากรอกชื่อจังหวัดใหม่ อันเดิมซ้ำ'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'response' => $validator->errors()
            ], 401);
        }

        $province = Province::create([
            'prov_name' => $request->prov_name,
            'prov_desc' => $request->prov_desc
        ]);

        return response()->json([
            'save' => true,
            'response' => $province
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show($province)
    {
        $province = Province::findOrFail($province);

        return response()->json([
            'data' => $province
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $province)
    {
        $province = Province::findOrFail($province);

        $validator = Validator::make($request->all(),[
            'prov_name' => 'required|unique:provinces',
        ],[
            'prov_name.required' => 'กรุณากรอกชื่อจังหวัด',
            'prov_name.unique' => 'กรุณากรอกชื่อจังหวัดใหม่ อันเดิมซ้ำ'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'response' => $validator->errors()
            ], 401);
        }

        $province->update([
            'prov_name' => $request->prov_name,
            'prov_desc' => $request->prov_desc
        ]);

        return response()->json([
            'save' => true,
            'data' => $province
        ],202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        //
    }
}
