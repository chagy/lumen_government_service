<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::paginate(20);

        return response()->json([
            'success' => true,
            'data' => DepartmentResource::collection($departments)
        ],200);
    }

    public function show($department) {
        $department = Department::findOrFail($department);

        return response()->json([
            'success' => true,
            'data' => new DepartmentResource($department)
        ],200);
    }
}
