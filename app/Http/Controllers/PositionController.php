<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Resources\PositionResource;

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
}
