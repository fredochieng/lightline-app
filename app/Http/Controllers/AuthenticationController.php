<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;

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

    public function forgort_password_form()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/user/auth/forgot-password', ['pageConfigs' => $pageConfigs]);
    }

    public function send_password_reset_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        /** Get verification data from mthe form */
        $email = $request->input('email');
        $token = Uuid::uuid4();

        /** Retrieve user details - correct/verification code that was sent during registration */
        $user = User::where('email', $email)->first();

        if ($user) {
            $save_reset_data = array(
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()->toDateTimeString()
            );

            $save_password_reset = DB::table('password_resets')->insert($save_reset_data);

            $data = [
                'title' => 'Reset Password',
                'reset_link' => url('/reset-password') . '?token=' . $token
            ];


            $email = EmailService::sendEmail($email,  RESET_PASSWORD_SUBJECT, 'emails.reset-password', $data);

            //flash()->success('Password reset instructions have been sent to your email address');
            //return view('landing.forgot-password');
        } else {
            /** Verification code invalid */
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'User does not registered!'
            ));
        }
    }

    public function resetPassword()
    {
        $data['token'] = request()->query('token');

        $token_data = DB::table('password_resets')->where('token', $data['token'])->first();

        if (!empty($token_data)) {
            $data['link_correct'] = 'Yes';
            $pageConfigs = ['blankPage' => true];
            return view('/user/auth/reset-password', ['pageConfigs' => $pageConfigs])->with($data);
        } else {
            $data['link_correct'] = 'No';
            //flash()->success('The password reset link was invalid. Send another request');
            $pageConfigs = ['blankPage' => true];

            return view('/user/auth/forgot-password', ['pageConfigs' => $pageConfigs]);
        }
    }

    public function resetPasswordProcess(Request $request)
    {
        // DB::beginTransaction();

        // try {
        // $this->validate($request, [
        //     'password' => 'required|confirmed|min:8'
        // ]);

        $token = $request->get('token');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');

        // $validator = Validator::make($request->all(), [
        //     'password' => 'required|confirmed|min:8'
        // ]);

        //if ($validator->fails()) {
        if ($password_confirmation != $password) {
            /** Verification code invalid */

            return json_encode(array(
                "statusCode" => 201,
                "message" => 'Passwords do not match'
            ));
        } else {
            // validation succeeded, continue with the logic
            $reset_data = DB::table('password_resets')->where('token', $token)->first();
            $user_email = $reset_data->email;

            $user_pass = array(
                'password' => Hash::make($password)
            );

            $update_password = User::where('email', $user_email)->update($user_pass);

            return json_encode(array(
                "statusCode" => 200,
                "message" => 'Password reset successful'
            ));
        }



        // } catch (Exception $e) {
        //     DB::rollback();
        //     // Log the exception instead of echoing it out
        //     Log::error($e);
        //     // Handle the exception as needed
        //     return back();
        // }
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
