<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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



        if (auth::attempt($userdata, $request->has('remember'))) { //this if validate if the user is on the database line 1

            // Check if the user has the "admin" role
            if ($request->user()->hasRole(Role::findByName('Admin'))) {
                $redirect_url = '/admin/panel/active';

                // Redirect to the admin dashboard...

            } else if ($request->user()->hasRole(Role::findByName('Panel'))) {
                // Redirect to the regular user dashboard...

                $user = User::where('email', $request->input('email'))->first();
                $userStatus = $user->status;
                if ($userStatus == 1) {
                    $redirect_url = '/user/profile/details';
                } else {
                    return json_encode(array(
                        "statusCode" => 201,
                        "message" => 'Your account is inactive'
                    ));
                }
            }

            return json_encode(array(
                "statusCode" => 200,
                "message" => 'Login successful',
                "redirect_url" => $redirect_url
            ));
        } else {
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'Incorrect email/password'
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
