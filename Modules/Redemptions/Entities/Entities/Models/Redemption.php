<?php

namespace Modules\Redemptions\Entities\Entities\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Redemptions\Database\factories\Entities / Models / RedemptionFactory::new();
    }

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
        $point_transactions = DB::table('point_transactions as pt')->select(
            DB::raw('pt.*')
        )
            ->where('pt.user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return $point_transactions;
    }
}
