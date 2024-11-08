<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobType;
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
            'name'        => 'required|min:5|max:20',
            'email'       => 'required|email|unique:users,email,' . $id . ',id',
            'mobile'      => 'nullable|digits_between:8,15',
            'designation' => 'nullable|string|max:50',
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

    // profile picture update
    public function updateProfilePic(Request $request) {
        $id        = Auth::user()->id;
        $user      = User::find($id);
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->passes()) {
            // Check if the user already has a profile picture
            if ($user->image && file_exists(public_path('/profile_pic/' . $user->image))) {
                unlink(public_path('/profile_pic/' . $user->image));
            }

            $image     = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $extension;
            $image->move(public_path('/profile_pic'), $imageName);
            $user->image = $imageName;
            $user->update();

            session()->flash('success', 'profile picture update successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
                'image'  => $imageName,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function createJob() {
        $categories = Category::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();
        $jobTypes = JobType::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();
        return view('front.account.job.create', compact(['categories', 'jobTypes']));
    }

    public function saveJob(Request $request) {
        try {
            //validation rules for job
            $validated = $request->validate([
                'title'        => 'required|min:5|max:200',
                'category'     => 'required',
                'job_type'     => 'required',
                'vacancy'      => 'required|integer',
                'location'     => 'required|max:50',
                'description'  => 'required',
                'company_name' => 'required|min:3|max:75',
            ]);

            // Return response for success
            toastr()->success('Your form has been submitted.');
            return back();
        } catch (\Exception $e) {
            // Return response fail
            toastr()->error($e->getMessage());
            return back();
        }
    }

}