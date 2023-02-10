<?php

namespace Modules\Panel\Entities\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Panel extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected function serializeDate($date)
    {
        return $date->format('Y-m-d');
    }

    protected static function newFactory()
    {
        return \Modules\Panel\Database\factories\Models\PanelFactory::new();
    }

    public static function getPanelProfile($user_id)
    {
        $user = DB::table('users as u')->select(
            DB::raw('u.*'),
            DB::raw('u.id as user_id'),
            DB::raw('u.created_at as registration_timestamp'),
            DB::raw('user_details.*'),
            DB::raw('countries.country_code'),
            DB::raw('countries.country_name'),
            DB::raw('education_level.id as edu_level_id'),
            DB::raw('education_level.education_level'),
            DB::raw('marital_status.id as mar_status_id'),
            DB::raw('marital_status.marital_status')

        )
            ->leftJoin('user_details', 'u.id', '=', 'user_details.user_id')
            ->leftJoin('countries', 'user_details.country_code', '=', 'countries.country_code')
            ->leftJoin('education_level', 'user_details.education_level_id', '=', 'education_level.id')
            ->leftJoin('marital_status', 'user_details.marital_status_id', '=', 'marital_status.id')
            ->where('u.id', '=', $user_id)
            ->first();

        return $user;
    }

    /** This function is similar to one above but uses get instead of first */
    public static function getPanelProfileForProfileCompletion($user_id)
    {
        $user_for_profile_completion = DB::table('users as u')->select(
            DB::raw('u.id as user_id'),
            /** The below 2 columns from users table are used to compute profile completion % */
            DB::raw('u.name'),
            DB::raw('u.email'),

            DB::raw('user_details.user_id'),

            /** The below 7 columns from user_details table are used to compute profile completion % */
            DB::raw('user_details.phone_number'),
            DB::raw('user_details.country_code'),
            DB::raw('user_details.dob'),
            DB::raw('user_details.gender'),
            DB::raw('user_details.education_level_id'),
            DB::raw('user_details.marital_status_id'),
            DB::raw('user_details.race_id'),

        )
            ->leftJoin('user_details', 'u.id', '=', 'user_details.user_id')
            ->where('u.id', '=', $user_id)
            ->get();

        return $user_for_profile_completion;
    }

    /** Get profile completeness percetagem of a user */
    public static function getProfileCompletionPer($profile)
    {
        $requiredFields = array("name", "email", "phone_number", "country_code", "dob", "gender", "education_level_id", "marital_status_id");
        $completedFields = 0;
        foreach ($requiredFields as $field) {
            if (!empty($profile[0]->$field)) {
                $completedFields++;
            }
        }
        $percentage = ($completedFields / count($requiredFields)) * 100;
        return round($percentage);
    }

    public static function getUserReferralLink($user_id)
    {
        $referral_code = User::find($user_id)->ref_code;
        return $referral_code;
    }

    /** Get user referral list */
    public static function getUserReferrals($user_id)
    {
        $user_referrals = User::where('referred_by', $user_id)->get();
        return $user_referrals;
    }

    /** Get a list of all panel - admin only */
    public static function getAllPanel()
    {
        // $users = User::where('id', '>', 1)->get();


        $users = User::leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->leftJoin('countries', 'user_details.country_code', '=', 'countries.country_code')
            ->leftJoin('education_level', 'user_details.education_level_id', '=', 'education_level.id')
            ->leftJoin('marital_status', 'user_details.marital_status_id', '=', 'marital_status.id')
            ->get(
                [
                    'users.id as user_id', 'users.name', 'users.email', 'users.status', 'users.registration_type', 'users.created_at', 'users.registration_type',
                    'user_details.panel_no', 'user_details.phone_number', 'user_details.age', 'user_details.gender', 'user_details.marital_status_id',
                    'user_details.education_level_id', 'countries.country_code', 'countries.country_name', 'education_level.id as edu_level_id',
                    'education_level.education_level', 'marital_status.id as mar_status_id', 'marital_status.marital_status'
                ]
            );

        return $users;
    }
}
