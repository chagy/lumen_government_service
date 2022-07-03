<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Resources\PositionResource;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function index() {
        $positions = Position::paginate(20);

        return response()->json([
            'success' => true,
            'data' => PositionResource::collection($positions)->response()->getData(true)
        ]);
    }

    public function show($position) {
        $position = Position::findOrFail($position);

        return response()->json([
            'success' => true,
            'data' => new PositionResource($position)
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'posi_name' => 'required|unique:positions',
            'posi_desc' => 'nullable'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $position = Position::create([
            'posi_name' => $request->posi_name,
            'posi_desc' => $request->posi_desc
        ]);

        return response()->json([
            'success' => true,
            'data' => new PositionResource($position)
        ]);
    }

    public function update(Request $request,$position) {
        $position = Position::findOrFail($position);

        $validator = Validator::make($request->all(),[
            'posi_name' => 'required|unique:positions,posi_name,'.$position->id,
            'posi_desc' => 'nullable'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $position->update([
            'posi_name' => $request->posi_name,
            'posi_desc' => $request->posi_desc
        ]);

        return response()->json([
            'success' => true,
            'data' => new PositionResource($position)
        ]);
    }
}
