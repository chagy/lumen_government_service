<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::paginate(20);

        return response()->json([
            'success' => true,
            'data' => DepartmentResource::collection($departments)->response()->getData(true)
        ],200);
    }

    public function show($department) {
        $department = Department::findOrFail($department);

        return response()->json([
            'success' => true,
            'data' => new DepartmentResource($department)
        ],200);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'parent_id' => 'nullable',
            'depa_num'  => 'required',
            'depa_name' => 'required|unique:departments',
            'depa_desc' => 'nullable',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ],400);
        }

        $department = Department::create([
            'parent_id' => $request->parent_id,
            'depa_num'  => $request->depa_num,
            'depa_name' => $request->depa_name,
            'depa_desc' => $request->depa_desc,
        ]);

        return response()->json([
            'success' => true,
            'data' => new DepartmentResource($department)
        ],201);
    }

    public function update(Request $request,$department) {
        $department = Department::findOrFail($department);

        $validator = Validator::make($request->all(),[
            'parent_id' => 'nullable',
            'depa_num'  => 'required',
            'depa_name' => 'required|unique:departments,depa_name,'.$department->id,
            'depa_desc' => 'nullable',
        ]);

        $department->update([
            'parent_id' => $request->parent_id,
            'depa_num'  => $request->depa_num,
            'depa_name' => $request->depa_name,
            'depa_desc' => $request->depa_desc,
        ]);

        return response()->json([
            'success' => true,
            'data' => new DepartmentResource($department)
        ],201);
    }

    public function destroy($department) {
        $department = Department::findOrFail($department);
        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'ลบข้อมูลเรียบร้อย'
        ],204);
    }

    public function restore($department) {
        $department = Department::onlyTrashed()->findOrFail($department);
        $department->restore();

        return response()->json([
            'success' => true,
            'message' => 'คืนข้อมูลเรียบร้อย'
        ],204);
    }

    public function forceDelete($department) {
        $department = Department::onlyTrashed()->findOrFail($department);
        $department->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'ลบข้อมูลเรียบร้อย'
        ],204);
    }
}
