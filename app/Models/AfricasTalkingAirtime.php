<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfricasTalkingAirtime extends Model
{
    use HasFactory;

    public static function get_ke_airtime_username()
    {
        $username = env('AT_AIRTIME_KE_USERNAME', '');

        return $username;
    }

    public static function get_ke_airtime_api_key()
    {
        $apiKey = env('AT_AIRTIME_KE_API_KEY', '');

        return $apiKey;
    }
}
