<?php

namespace App\Http\Controllers;

use App\adLDAP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    // Login v1
    public function login_form()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/user/auth/login', ['pageConfigs' => $pageConfigs]);
    }

    public function authenticateUser(Request $request)
    {

        /** Get login data from the form */
        $remember = ($request->has('remember')) ? true : false;
        $userdata = array(
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        );

        // DB::table('users')->where(array('username' => $username))->update(array(
        //     'password' => Hash::make($password)
        // ));

        if (auth::attempt($userdata, $request->has('remember'))) { //this if validate if the user is on the database line 1

            /** Check if the user is active and account verified */
            //$user = 
            return json_encode(array(
                "statusCode" => 200,
                "message" => 'Login successful'
            ));
            return redirect('/user/profile/details');
        } else {
            return json_encode(array(
                "statusCode" => 200,
                "message" => 'Login failed'
            ));
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        Auth::logout();

        return redirect('/auth/user/login');
    }

    // public function logout(Request $request)
    // {
    //   $request->user()->token()->revoke();
    //   return response()->json([
    //     'message' => 'Successfully logged out'
    //   ]);
    // }
}
