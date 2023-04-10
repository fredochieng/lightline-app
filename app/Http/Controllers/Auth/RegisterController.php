<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Modules\Panel\Entities\UserDetails;

class RegisterController extends Controller
{
    public function registration_form()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/user/auth/register', ['pageConfigs' => $pageConfigs]);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function checkPhone(Request $request)
    {
        $phone = $request->input('phone');
        $user = UserDetails::where('phone_number', $phone)->first();

        if ($user) {
            return response()->json(false);
        }

        return response()->json(true);
    }


    public function register(Request $request)
    {
        /** Get registration data from the form */
        $name = ucfirst($request->input('name'));
        $phone_number = $request->input('phone');
        $email = strtolower($request->input('email'));
        $country_code = $request->input('country_code');
        $password = $request->input('password');

        /** Generate 6-digit verification code for the user */
        $verification_code = substr(str_shuffle("0123456789"), 0, 6);
        $user_ref_code = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));

        $user = new User();

        /** Check if the user has been referred by another user
         * Check for the ref parameter in the URL
         */

        // // Get Protocol https or http
        // $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // Append Host Name and requested resource location
        $url = $_SERVER['HTTP_REFERER'];
        $url_components = parse_url($url);

        /** Check if URL has ref param */
        if (array_key_exists('query', $url_components)) {

            parse_str($url_components['query'], $params);

            /** Get referral code
             * This can also apply for other params that will 
             * be available in future release
             */
            $ref_code = $params['ref'];

            /** Get referrer - user who referred the one registering */
            $referrer_id = User::where('ref_code', $ref_code)->first()->id;
            $user->referred_by = $referrer_id;
            $user->registration_type = 2;
            // dd($referrer_id);
        } else {
            $user->registration_type = 1;
        }

        DB::beginTransaction();

        try {

            /** Save the registration data - users table */

            $user->name = $name;
            $user->email = $email;
            $user->verification_code = $verification_code;
            $user->ref_code = $user_ref_code;
            $user->password = Hash::make($password);
            $user->save();

            /** Get id of saved user */
            $user_id = $user->id;

            /** Save absic user details such as phone, country code 
             * to user_details table */
            $panel_number = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6));
            $user_details = array(
                "user_id" => $user_id,
                "country_code" => $country_code,
                "phone_number" => $phone_number,
                "panel_no" => $panel_number
            );

            $save_user_details = DB::table('user_details')->insert($user_details);

            /** Assign role to the user (User role) */

            $user_role = array(
                "model_id" => $user_id,
                "model_type" => "App\User",
                "role_id" => 1
            );

            $save_user_role = DB::table('model_has_roles')->insert($user_role);

            $data = [
                'title' => 'Verify Account',
                'verirication_code' => $user->verification_code
            ];

            //$email = EmailService::sendEmail($user->email,  'Verify Email', 'emails.reset-password', $data);

            DB::commit();

            /** Return response with status code */
            return json_encode(array(
                "statusCode" => 200,
                "bba9f6361764d423317d202402d57190" => $user_id,
                "message" => 'Registration successful'
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e);
            /** Return response with status code */
            return json_encode(array(
                "statusCode" => 201,
                "bba9f6361764d423317d202402d57190" => 'h',
                "message" => 'Registration failed'
            ));
        }
    }

    /** Display the verification form */
    public function verify_form(Request $request)
    {
        $user_iden = $request->input('a2fc0b91fe81da0904a2dd407abca5879ca55839f3a4ebcf6f192814ad220bb4cf358d1adbf51199ee7f64d41f8d18be');
        $pageConfigs = ['blankPage' => true];

        return view('/user/auth/account-verify', [
            'pageConfigs' => $pageConfigs,
            'c3f5ffa0e4b13671f15334aa066d20b9' => $user_iden
        ]);
    }

    public function verify_account(Request $request)
    {
        /** Get verification data from mthe form */
        $user_id = $request->input('fc0b91fe81da0904a2dd407abc');
        $ver_code = $request->input('f6f192814ad220bb4cf358d1ad');

        /** Retrieve user details - correct/verification code that was sent during registration */
        $user = User::where('id', $user_id)->first();

        if ($user) {
            $reg_ver_code = $user->verification_code;
            /** Check if the supplied and correct verification codes match */
            if ($ver_code == $reg_ver_code) {

                DB::beginTransaction();

                try {

                    /** Verify and activate user account */
                    DB::table('users')->where('id', $user_id)
                        ->update([
                            'email_verified_at' => Carbon::now('Africa/Nairobi')->toDateTimeString(),
                            'status' => 1
                        ]);

                    /** Award user welcome points on account activation */
                    $welcome_points = 50;
                    DB::table('user_points')
                        ->insert([
                            'user_id' => $user_id,
                            'points_earned' => $welcome_points,
                            'points_balance' => $welcome_points
                        ]);

                    /** Save points history (transaction) */
                    $activity = 'Sign Up';
                    $tx_type = 'Credit';
                    $transaction_id = substr(str_shuffle("0123456789"), 0, 8);
                    DB::table('point_transactions')
                        ->insert([
                            'user_id' => $user_id,
                            'points' => $welcome_points,
                            'transaction_id' => $transaction_id,
                            'activity' => $activity,
                            'tx_type' => $tx_type,
                            'created_at' => Carbon::now('Africa/Nairobi')->toDateTimeString(),
                            'updated_at' => Carbon::now('Africa/Nairobi')->toDateTimeString()
                        ]);

                    DB::commit();

                    /** Return successful message */
                    return json_encode(array(
                        "statusCode" => 200,
                        "message" => 'Account activated successfully'
                    ));
                } catch (\Exception $e) {
                    dd($e);
                    DB::rollBack();
                    /** Return response with status code */
                    return json_encode(array(
                        "statusCode" => 201,
                        "message" => 'Account activation failed'
                    ));
                }
            } else {
                /** Verification code invalid */
                return json_encode(array(
                    "statusCode" => 201,
                    "message" => 'Verification code invalid or expired'
                ));
            }
        } else {
            /** Verification code invalid */
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'User does not exist'
            ));
        }
    }
}
