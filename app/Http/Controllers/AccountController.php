<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller {
    // this method use for user registration
    public function registration() {
        return view('front.account.registration');
    }

    //process registration
    public function processRegistration(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'             => 'required',
            'email'            => 'required|email|unique:users, email',
            'password'         => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        } else {

            $user           = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = $request->password;
            $user->save();

            session()->flash('success', 'You Have Registered Successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        }
    }

    // this method use for user login
    public function login() {
        return view('front.account.login');
    }
}
