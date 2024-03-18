<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.'],
            // ]);
            return response()->json(['message', 'The provided credentials are incorrect.', $user]);
        }
        if ($user->role === 'super_admin') {
            return response()->json([
                'message' => 'Super Admin Loged Successfully',
                'customer' => $user,
                'token' => $user->createToken('super_admin', ['superadmin'])->plainTextToken
            ]);
        } elseif ($user->role === 'admin') {
            return response()->json([
                'message' => 'admin Loged Successfully',
                'customer' => $user,
                'token' => $user->createToken('admin', ['admin'])->plainTextToken
            ]);
        } else {
            return response()->json([
                'message' => 'Resident Loged Successfully',
                'customer' => $user,
                'token' => $user->createToken('resident', ['resident'])->plainTextToken
            ]);
        }
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:7',
            'cin' => 'required|string|size:7|regex:/^[0-9]{7}$/',
            'phone' => 'required|string|size:8|regex:/^[0-9]{8}$/',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $residentData = $request->all();
        $residentData['role'] = 'resident';
        $user = User::create($residentData);

        //$user = User::create([$request->all()]);
        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;
        $response = [
            'status' => 'success',
            'message' => 'User is created successfully.',
            'data' => $data,
        ];
        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        $user = auth()->user()->tokens()->first()->name;
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' =>$user.' is logged out successfully'
        ], 200);
    }

    //     public function logout(Request $request)
// {
//     $request->user()->tokens()->delete();

    //     return response()->json([
//     'message' => 'Successfully logged out'
//     ]);

    // }
//    

}
