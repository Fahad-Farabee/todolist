<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    //user sign up.
    function signup(Request $request)
    {
        $rules = array(
            'name' => 'required|max:50|min:2',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com', 'yahoo.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail("Only gmail.com or yahoo.com addresses are allowed.");
                    }
                }
            ],
            'password' => 'required|min:2|max:8'
        );
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'msg' => "Incorrect input formats",
            ], 403);
        } else {
            $input = $request->all();
            $input["password"] = bcrypt($input["password"]);
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            return response()->json([
                'success' => true,
                'result' => $success,
                'msg' => "User registered successfully!"
            ], 200);
        }
    }

    //user login.
    function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'msg' => "Incorrect input formats",
            ], 403);
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) { //if no user is found
                return response()->json([
                    'success' => false,
                    'msg' => "Wrong or Invalid credentials!",
                ], 401);
            } else { //if user is found 
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                /* $success['name'] = $user->name; */
                return response()->json([
                    'success' => true,
                    'result' => $success,
                    'msg' => "User logged in successfully!"
                ], 200);
            }
        }
    }
}
