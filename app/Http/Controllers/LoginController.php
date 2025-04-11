<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // This method will show login page for user 
    public function index() {
        return view('user.login');
    }

    // This method will authenticate user
    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.dashboard');
            } else {
                return redirect()->route('account.login')->with('error','Either email or password is incorrect.');
            }
        } else {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }

    // This method will show register page 
    public function register() {
        return view('user.register');
    }

    // This method will register form store databse
    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('account.login')->with('success', 'You have register successfully.');
        } else {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

    }

    // This method will logout user 
    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
