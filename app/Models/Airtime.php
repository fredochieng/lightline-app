<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\AfricasTalkingAirtime;

class Airtime extends Model
{
    protected $fillable = [];

    public static function get_AT_application_data()
    {
        $ke_airtime_username = AfricasTalkingAirtime::get_ke_airtime_username();
        $ke_airtime_api_key   = AfricasTalkingAirtime::get_ke_airtime_api_key();

        // Initialize the SDK
        $AT = new AfricasTalking($ke_airtime_username, $ke_airtime_api_key);

        // Get one of the services
        $bal = $AT->application()->fetchApplicationData();

        if ($bal['status'] == 'success') {
            return array('status' => 1, 'balance' => explode(" ", $bal['data']->UserData->balance));
        } else {
            return array('status' => 0, 'balance' => 0);
        }
    }
}
