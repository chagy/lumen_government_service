<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\GovernmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GovernmentServiceController extends Controller
{
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
            'data' => $gose
        ]);
    }
}
