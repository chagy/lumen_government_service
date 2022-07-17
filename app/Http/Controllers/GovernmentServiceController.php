<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\GovernmentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\GovernmentServiceItem;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\GovernmentServiceResource;

class GovernmentServiceController extends Controller
{
    public function index() {
        
        $government_services = GovernmentService::where('user_id',Auth::guard('api')->id())->paginate(20);
        
        return response()->json([
            'success' => true,
            'data' => GovernmentServiceResource::collection($government_services)->response()->getData(true)
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'gose_num'                  => 'required',
            'gose_category'             => ['required',Rule::in([1,2,3,99])],
            'gose_inout_province'       => ['required',Rule::in([1,2,99])],
            'gose_withdraw'             => ['required',Rule::in([1,2,3,99])],
            'gose_withdraw_na'          => 'required|boolean',
            'gose_withdraw_allowance'   => 'required|boolean',
            'gose_withdraw_rest'        => 'required|boolean',
            'gose_withdray_other'       => 'nullable',
            'gose_date_start'           => 'required|date',
            'gose_time_start'           => 'required',
            'gose_date_end'             => 'required|date',
            'gose_time_end'             => 'required',
            'gose_vehicle'              => ['required',Rule::in([1,2,3,4])],
            'gose_car_regis'            => 'nullable',
            'driver_id'                 => 'nullable',
            'gose_about'                => 'required',
            'gose_place'                => 'required',
            'gose_district'             => 'required',
            'gose_province'             => 'required',
            'gose_traveler'             => 'required',
            'gose_desc'                 => 'nullable',
            'gose_file'                 => 'nullable|mimes:pdf',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $nameFile = null;

        if($request->hasFile('gose_file')) {
            $nameFile = Str::random(10).date('Y-m-d-H-i').'.pdf';
            $request->file('gose_file')->move('./documents',$nameFile);
        }

        $gose = GovernmentService::create([
            'department_id'             => Auth::user()->department_id,
            'sub_department_id'         => Auth::user()->sub_department_id,
            'gose_num'                  => Auth::user()->department->depa_num.'/'.$request->gose_num,
            'gose_save'                 => date('Y-m-d'),
            'gose_date'                 => date('Y-m-d'),
            'user_id'                   => Auth::user()->id,
            'position_id'               => Auth::user()->position_id,
            'gose_category'             => $request->gose_category,
            'gose_inout_province'       => $request->gose_inout_province,
            'gose_withdraw'             => $request->gose_withdraw,
            'gose_withdraw_na'          => $request->gose_withdraw_na,
            'gose_withdraw_allowance'   => $request->gose_withdraw_allowance,
            'gose_withdraw_rest'        => $request->gose_withdraw_rest,
            'gose_withdray_other'       => $request->gose_withdray_other,
            'gose_date_start'           => $request->gose_date_start,
            'gose_time_start'           => $request->gose_time_start,
            'gose_date_end'             => $request->gose_date_end,
            'gose_time_end'             => $request->gose_time_end,
            'gose_num_day'              => $request->gose_num_day,
            'gose_vehicle'              => $request->gose_vehicle,
            'gose_car_regis'            => $request->gose_car_regis,
            'gose_about'                => $request->gose_about,
            'gose_place'                => $request->gose_place,
            'gose_district'             => $request->gose_district,
            'gose_province'             => $request->gose_province,
            'gose_traveler'             => $request->gose_traveler,
            'leader_id'                 => Auth::user()->leader_id,
            'commander_id'              => Auth::user()->commander_id,
            'director_id'               => Auth::user()->director_id,
            'gose_desc'                 => $request->gose_desc,
            'gose_file'                 => $nameFile,
        ]);

        $gose->travelers()->create([
            'user_id' => Auth::user()->id,
            'position_id' => Auth::user()->position_id,
            'gose_item_full_name' => Auth::user()->u_prefix.Auth::user()->u_first_name.' '.Auth::user()->u_last_name,
            'gose_item_position' => Auth::user()->position->posi_name,
            'gose_type' => 1,
        ]);

        return response()->json([
            'success' => 'true',
            'data' => new GovernmentServiceResource($gose)
        ]);
    }

    public function update(Request $request,$government_service) {
        $government_service = GovernmentService::findOrFail($government_service);

        $validator = Validator::make($request->all(),[
            'gose_num'                  => 'required',
            'gose_category'             => ['required',Rule::in([1,2,3,99])],
            'gose_inout_province'       => ['required',Rule::in([1,2,99])],
            'gose_withdraw'             => ['required',Rule::in([1,2,3,99])],
            'gose_withdraw_na'          => 'required|boolean',
            'gose_withdraw_allowance'   => 'required|boolean',
            'gose_withdraw_rest'        => 'required|boolean',
            'gose_withdray_other'       => 'nullable',
            'gose_date_start'           => 'required|date',
            'gose_time_start'           => 'required',
            'gose_date_end'             => 'required|date',
            'gose_time_end'             => 'required',
            'gose_vehicle'              => ['required',Rule::in([1,2,3,4])],
            'gose_car_regis'            => 'nullable',
            'driver_id'                 => 'nullable',
            'gose_about'                => 'required',
            'gose_place'                => 'required',
            'gose_district'             => 'required',
            'gose_province'             => 'required',
            'gose_traveler'             => 'required',
            'gose_desc'                 => 'nullable',
            'gose_file'                 => 'nullable|mimes:pdf',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $nameFile = null;

        if($request->hasFile('gose_file')) {
            $nameFile = Str::random(10).date('Y-m-d-H-i').'.pdf';
            $request->file('gose_file')->move('./documents',$nameFile);
            if($government_service->gose_file) {
                @unlink('./documents/'.$government_service->gose_file);
            }
        }

        $government_service->update([
            'gose_num'                  => Auth::user()->department->depa_num.'/'.$request->gose_num,
            'gose_date'                 => $request->gose_date,
            'gose_category'             => $request->gose_category,
            'gose_inout_province'       => $request->gose_inout_province,
            'gose_withdraw'             => $request->gose_withdraw,
            'gose_withdraw_na'          => $request->gose_withdraw_na,
            'gose_withdraw_allowance'   => $request->gose_withdraw_allowance,
            'gose_withdraw_rest'        => $request->gose_withdraw_rest,
            'gose_withdray_other'       => $request->gose_withdray_other,
            'gose_date_start'           => $request->gose_date_start,
            'gose_time_start'           => $request->gose_time_start,
            'gose_date_end'             => $request->gose_date_end,
            'gose_time_end'             => $request->gose_time_end,
            'gose_num_day'              => $request->gose_num_day,
            'gose_vehicle'              => $request->gose_vehicle,
            'gose_car_regis'            => $request->gose_car_regis,
            'gose_about'                => $request->gose_about,
            'gose_place'                => $request->gose_place,
            'gose_district'             => $request->gose_district,
            'gose_province'             => $request->gose_province,
            'gose_traveler'             => $request->gose_traveler,
            'gose_desc'                 => $request->gose_desc,
            'gose_file'                 => $nameFile,
        ]);

        return response()->json([
            'success' => 'true',
            'data' => new GovernmentServiceResource($government_service)
        ]);
    }

    public function chooseEmployee($government_service,$employee) {
        $government_service = GovernmentService::findOrFail($government_service);
        $employee = User::findOrFail($employee);

        if(!DB::table('government_service_items')->where('government_service_id',$government_service->id)->where('user_id',$employee->id)->exists()) {
            $government_service->travelers()->create([
                'user_id' => $employee->id,
                'position_id' => $employee->position_id,
                'gose_item_full_name' => $employee->u_prefix.$employee->u_first_name.' '.$employee->u_last_name,
                'gose_item_position' => $employee->position->posi_name,
                'gose_type' => 2,
            ]);

            return response()->json([
                'success' => true,
                'data' => $government_service->travelers,
            ],200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'เจ้าหน้าที่ท่านนี้ถูกเลือกไปแล้ว',
                'data' => $government_service->travelers,
            ],400);
        }
    }

    public function deleteEmployee($government_service,$employee) {
        $item = GovernmentServiceItem::where('government_service_id',$government_service)
                    ->where('user_id',$employee)
                    ->first();

        if($item) {
            $item->delete();
            return response()->json([
                'success' => true,
                'message' => 'ลบข้อมูลเรียบร้อย',
            ],204);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'เจ้าหน้าที่ท่านนี้ไม่มีในรายการ',
                'data' => $government_service->travelers,
            ],400);
        }
    }

    public function destroy($government_service) {
        $government_service = GovernmentService::findOrFail($government_service);
        $government_service->delete();

        return response()->json([
            'success' => true,
            'message' => 'ลบข้อมูลเรียบร้อย'
        ],204);
    }

    public function restore($government_service) {
        $government_service = GovernmentService::onlyTrashed()->findOrFail($government_service);
        $government_service->restore();

        return response()->json([
            'success' => true,
            'message' => 'คืนข้อมูลเรียบร้อย'
        ],204);
    }

    public function forceDelete($government_service) {
        $government_service = GovernmentService::onlyTrashed()->findOrFail($government_service);
        $government_service->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'ลบข้อมูลเรียบร้อย'
        ],204);
    }

    public function listApprove() {
        $lists = [];
        $type = Auth::guard('api')->user()->u_type;
        $user_id = Auth::guard('api')->id();

        switch ($type) {
            case 1:
                $lists = GovernmentService::where('director_id',$user_id)->where('gose_send',2)->paginate(20);
                break;
            case 2:
                $lists = GovernmentService::where('commander_id',$user_id)->where('gose_send',3)->paginate(20);
                break;
            case 3:
                $lists = GovernmentService::where('leader_id',$user_id)->where('gose_send',4)->paginate(20);
                break;
            default:
                $lists = [];
                break;
        }

        return response()->json([
            'success' => true,
            'data' => GovernmentServiceResource::collection($lists)->response()->getData(true)
        ]);
    }

    public function oneApprove(Request $request,$government_service) {
        $type = Auth::guard('api')->user()->u_type;
        $user_id = Auth::guard('api')->id();
        $condition = [];
        $approve = [];

        switch ($type) {
            case 1:
                $condition = [
                    'id' => $government_service,
                    'director_id' => $user_id,
                    'gose_send' => 2
                ];
                $approve = [
                    'director_comment' => $request->comment,
                    'director_status' => $request->status,
                    'director_date' => date('Y-m-d H:i:s'),
                    'gose_status' => $request->status,
                    'gose_send' => 1
                ];
                break;
            case 2:
                $condition = [
                    'id' => $government_service,
                    'commander_id' => $user_id,
                    'gose_send' => 3
                ];
                $approve = [
                    'commander_comment' => $request->comment,
                    'commander_status' => $request->status,
                    'commander_date' => date('Y-m-d H:i:s'),
                    'gose_status' => $request->status == 0 ? 0 : 99,
                    'gose_send' => $request->status == 0 ? 1 : 2
                ];
                break;
            case 3:
                $condition = [
                    'id' => $government_service,
                    'leader_id' => $user_id,
                    'gose_send' => 4
                ];
                $approve = [
                    'leader_comment' => $request->comment,
                    'leader_status' => $request->status,
                    'leader_date' => date('Y-m-d H:i:s'),
                    'gose_status' => $request->status == 0 ? 0 : 99,
                    'gose_send' => $request->status == 0 ? 1 : 3
                ];
                break;
            default:
                $condition = [];
                $approve = [];
                break;
        }

        if(!empty($condition) && !empty($approve)) {
            $government_service = GovernmentService::where($condition)->firstOrFail();
            $government_service->update($approve);

            return response()->json([
                'success' => true,
                'data' => new GovernmentServiceResource($government_service)
            ]);
        }
    }

    public function multiApprove(Request $request) {
        $type = Auth::guard('api')->user()->u_type;
        $user_id = Auth::guard('api')->id();
        $ids = $request->ids;
        $condition = [];
        $approve = [];

        switch ($type) {
            case 1:
                $condition = [
                    'director_id' => $user_id,
                    'gose_send' => 2
                ];
                $approve = [
                    'director_comment' => $request->comment,
                    'director_status' => $request->status,
                    'director_date' => date('Y-m-d H:i:s'),
                    'gose_status' => $request->status,
                    'gose_send' => 1
                ];
                break;
            case 2:
                $condition = [
                    'commander_id' => $user_id,
                    'gose_send' => 3
                ];
                $approve = [
                    'commander_comment' => $request->comment,
                    'commander_status' => $request->status,
                    'commander_date' => date('Y-m-d H:i:s'),
                    'gose_status' => $request->status == 0 ? 0 : 99,
                    'gose_send' => $request->status == 0 ? 1 : 2
                ];
                break;
            case 3:
                $condition = [
                    'leader_id' => $user_id,
                    'gose_send' => 4
                ];
                $approve = [
                    'leader_comment' => $request->comment,
                    'leader_status' => $request->status,
                    'leader_date' => date('Y-m-d H:i:s'),
                    'gose_status' => $request->status == 0 ? 0 : 99,
                    'gose_send' => $request->status == 0 ? 1 : 3
                ];
                break;
            default:
                $condition = [];
                $approve = [];
                break;
        }

        if(!empty($condition) && !empty($approve)) {
            $government_services = GovernmentService::whereIn('id',$ids)->where($condition);
            $government_services->update($approve);

            return response()->json([
                'success' => true,
                'message' => 'อนุมัติข้อมูลเรียบร้อยแล้ว'
            ],204);
        }
    }
}
