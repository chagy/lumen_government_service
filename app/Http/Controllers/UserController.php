<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(20);

        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users)->response()->getData(true)
        ],200);
    }
}
