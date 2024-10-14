<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'email'            => 'required|email|unique:users,email',
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

    //check login access
    public function checkLogin(Request $request) {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:5',
        ]);

        if (Auth::attempt($validated)) {
            return redirect()->route('account.profile');
        }
        return back()->withErrors([
            'email' => 'The credentials do not match our records.',
        ])->onlyInput('email');
    }

    //profile section
    public function profile() {
        $id   = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('front.account.profile', compact('user'));
    }

    //update profile
    public function updateProfile(Request $request) {
        $id = Auth::user()->id;

        // Correct validation rules with 'required' instead of 'request'
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20', // Corrected 'required'
            'email' => 'required|email|unique:users,email,' . $id . ',id', // Corrected 'required'
            'mobile' => 'nullable|digits_between:8,15', // Optional validation for mobile
            'designation' => 'nullable|string|max:50', // Optional validation for designation
        ]);

        if ($validator->passes()) {
            // Fetch and update user
            $user              = User::find($id);
            $user->name        = $request->name;
            $user->email       = $request->email;
            $user->mobile      = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            // Return success response
            session()->flash('success', 'Profile updated successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            // Return error response with validation errors
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    // logout
    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }
}