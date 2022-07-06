<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'u_prefix' => 'required',
            'u_first_name' => 'required',
            'u_last_name' => 'required',
            'u_nick_name' => 'required',
            'u_phone' => 'required',
            'u_birthday' => 'required',
            'u_workday' => 'required',
            'u_officerday' => 'nullable',
            'u_address' => 'required',
            'sub_district_id' => 'required|integer',
            'district_id' => 'required|integer',
            'province_id' => 'required|integer',
            'u_zipcode' => 'required',
            'position_id' => 'required|integer',
            'department_id' => 'required|integer',
            'sub_department_id' => 'required|integer',
            'leader_id' => 'nullable',
            'commander_id' => 'nullable',
            'director_id' => 'nullable',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $user = User::create([
            'username'          => $request->username,
            'password'          => Hash::make($request->password),
            'u_prefix'          => $request->u_prefix,
            'u_first_name'      => $request->u_first_name,
            'u_last_name'       => $request->u_last_name,
            'u_nick_name'       => $request->u_nick_name,
            'u_phone'           => $request->u_phone,
            'u_birthday'        => $request->u_birthday,
            'u_workday'         => $request->u_workday,
            'u_officerday'      => $request->u_officerday,
            'u_address'         => $request->u_address,
            'sub_district_id'   => $request->sub_district_id,
            'district_id'       => $request->district_id,
            'province_id'       => $request->province_id,
            'u_zipcode'         => $request->u_zipcode,
            'position_id'       => $request->position_id,
            'department_id'     => $request->department_id,
            'sub_department_id' => $request->sub_department_id,
            'leader_id'         => $request->leader_id,
            'commander_id'      => $request->commander_id,
            'director_id'       => $request->director_id,
        ]);

        
        $user['token'] = $user->createToken('chagy')->accessToken;

        return response()->json($user,200);
    }
}
