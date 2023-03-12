<?php

namespace Modules\Panel\Http\Controllers;

use App\Models\Country;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\MessageCenter\Entities\ReferralEmails;
use Modules\Panel\Entities\Models\Panel;
use Modules\Redemptions\Entities\Entities\Models\Redemption;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function profile()
    {
        /** Get panel profile data */
        $data['user_id'] = Auth::user()->id;
        $data['user_profile_data'] = Panel::getPanelProfile($data['user_id']);

        /** Get panel profile completion percentage */
        $user_for_profile_completion = Panel::getPanelProfileForProfileCompletion($data['user_id']);
        $data['profile_complete_per'] = Panel::getProfileCompletionPer($user_for_profile_completion->toArray());

        $data['countries'] = Country::getCountries();
        $data['marital_status'] = Setting::getMaritalStatus();
        $data['education_levels'] = Setting::getEducationLevels();
        $data['races'] = Setting::getRaces();

        // echo "<pre>";
        // print_r($data['countries']);
        // exit;

        /** Move the panel to Panel Module */
        return view('panelprofile::profile/account-settings')->with($data);
    }

    public function update_profile(Request $request)
    {
        /** Get form data */
        $user_id = $request->input('l9ky0xwifr3sqtzv');
        $dob = $request->input('dob');
        $gender = $request->input('gender');
        $education_level_id = $request->input('education_level_id');
        $marital_status_id = $request->input('marital_status_id');
        $race_id = $request->input('race_id');

        /** Compute use age from the DOB */
        $user_age = Carbon::now('Africa/Nairobi')->diffInYears(Carbon::parse($dob));

        DB::beginTransaction();

        try {
            /** Update user profile */
            DB::table('user_details')->where('user_id', $user_id)
                ->update([
                    'gender' => $gender,
                    'dob' => $dob,
                    'age' => $user_age,
                    'education_level_id' => $education_level_id,
                    'marital_status_id' => $marital_status_id
                    //'race_id' => $race_id
                ]);

            DB::commit();
            return json_encode(array(
                "statusCode" => 200,
                "message" => 'Profile updated successfully'
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            /** Return response with status code */
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'An error occured... try again'
            ));
        }
    }

    public function changePass(Request $request)
    {
        /** Get form data */
        $user_id = $request->input('l9ky0xwifr3sqtzv');
        $current_pass = $request->input('current_pass');
        $new_pass = $request->input('new_pass');
        $confirm_pass = $request->input('confirm_pass');
        $user = User::find($user_id);

        DB::beginTransaction();

        try {
            if (Hash::check($current_pass, $user->password)) {

                if ($new_pass == $confirm_pass) {
                    $user_pass = array(
                        'password' => Hash::make($new_pass)
                    );

                    $update_password = User::where('id', $user_id)->update($user_pass);
                    DB::commit();

                    return json_encode(array(
                        "statusCode" => 200,
                        "message" => 'Password changed successfully'
                    ));
                } else {
                    return json_encode(array(
                        "statusCode" => 201,
                        "message" => 'confirm password does not match new password'
                    ));
                }
            } else {
                return json_encode(array(
                    "statusCode" => 201,
                    "message" => 'Current password is incorrect'
                ));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            /** Return response with status code */
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'An error occured... try again'
            ));
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
        }
    }

    /** Send invites */
    public function userSendInvites(Request $request)
    {
        /** Get form data */
        $user_id = $request->input('l9ky0xwifr3sqtzv');
        $emails = $request->input('emails');
        $myRefLink = $request->input('myRefLink');

        DB::beginTransaction();

        try {
            $emails_array = explode(",", $emails);

            foreach ($emails_array as $email) {
                $ref_emails = new ReferralEmails();
                $ref_emails->to_email = $email;
                $ref_emails->referrer_link = $myRefLink;
                $ref_emails->save();
            }

            DB::commit();
            return json_encode(array(
                "statusCode" => 200,
                "message" => 'Invites sent successfully'
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            /** Return response with status code */
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'An error occured... try again'
            ));
        }
    }

    /** Function to display the invites view */
    public function userInvites()
    {
        $data['user_id'] = Auth::user()->id;
        $refferal_code = Panel::getUserReferralLink($data['user_id']);
        $site_link = ENV('APP_URL');
        $data['ref_link'] = $site_link . '/auth/user/register?ref=' . $refferal_code;

        return view('panel::invites/invites')->with($data);
    }

    /** Function to load the invites data */
    public function getUserReferralsData()
    {
        $user_id = Auth::user()->id;
        $user_referrals = Panel::getUserReferrals($user_id);
        $userReferrals['data'] = $user_referrals;
        return response()->json($userReferrals);
    }

    /** Get all active panel for admin user */
    function panelActiveBlade()
    {
        return view('admin::panel-management/active-panel');
    }
    /** Get all active panel for admin user */
    function panelActiveFetch()
    {
        $activePanel = Panel::getAllPanel();
        $active_panel['data'] = $activePanel;
        return response()->json($active_panel);
    }

    /** Get panle details */
    function getPanelDetails($id = null)
    {
        $data['panel_details'] = Panel::getPanelProfile($id);
        $data['panel_points'] = Redemption::getUserPoints($id);

        $data['point_transactions'] = Redemption::getUserPointTransactions($id);
        $data['point_transactions'] = $data['point_transactions']->where('user_id', $id);
        $data['panel_redemptions'] = Redemption::getUserRedemption($id);
        $data['panel_referrals'] = Panel::getUserReferrals($id);
        //$active_panel['data'] = $data['panel_details'];
        return view('admin::panel-management/panel-details')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('panel::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('panel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('panel::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
