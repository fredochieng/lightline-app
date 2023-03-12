<?php

namespace Modules\Redemptions\Entities\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Redemption extends Model
{
    // use HasRoles;

    protected $fillable = [];

    protected $casts = [
        'created_at' => "datetime:Y-m-d H:i:s",
    ];

    /** Get user points */
    public static function getUserPoints($user_id)
    {
        $user_points = DB::table('user_points as up')->select(
            DB::raw('up.*')
        )
            ->where('up.user_id', $user_id)
            ->first();

        return $user_points;
    }

    /** Function to get user redemtpions */
    public static function getUserRedemption($user_id)
    {
        $redemptions = Redemption::where('user_id', $user_id)
            ->orderBy('created_at')
            ->get();

        return $redemptions;
    }

    /** Get user point transactions */
    public static function getUserPointTransactions($user_id)
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first(); // Returns a collection

        if ($userRole == "Panel") {
            $comprare_field = 'pt.user_id';
            $comprare_op = '=';
            $comprare_value = $user_id;
        } else {
            $comprare_field = 'pt.user_id';
            $comprare_op = '>';
            $comprare_value = 0;
        }
        $point_transactions = DB::table('point_transactions as pt')->select(
            DB::raw('pt.*'),
            DB::raw('panel_no'),
            DB::raw('country_name')
        )
            ->where($comprare_field, $comprare_op, $comprare_value)
            ->join('user_details', 'pt.user_id', '=', 'user_details.user_id')
            ->join('countries', 'user_details.country_code', '=', 'countries.country_code')
            ->orderBy('created_at', 'asc')
            ->get();

        // dd($point_transactions);
        return $point_transactions;
    }

    /** Get panel redemptions by admin */
    public static function getPanelRedemptions()
    {
        $redemptions = DB::table('redemptions as rd')->select(
            DB::raw('rd.*'),
            DB::raw('panel_no'),
            DB::raw('country_name')
        )
            ->join('user_details', 'rd.user_id', '=', 'user_details.user_id')
            ->join('countries', 'user_details.country_code', '=', 'countries.country_code')
            ->orderBy('created_at', 'asc')
            ->get();

        return $redemptions;
    }
}
