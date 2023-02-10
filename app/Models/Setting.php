<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    use HasFactory;

    /** Get all education levels in the database */
    public static function getEducationLevels()
    {
        $education_levels = DB::table('education_level as e')
            ->select(
                DB::raw('e.id as education_level_id'),
                DB::raw('e.education_level')
            )
            ->orderBy('e.id', 'asc')
            ->get();
        return $education_levels;
    }

    /** Get all marital status in the database */
    public static function getMaritalStatus()
    {
        $marital_status = DB::table('marital_status as m')
            ->select(
                DB::raw('m.id as marital_status_id'),
                DB::raw('m.marital_status')
            )
            ->orderBy('m.id', 'asc')
            ->get();
        return $marital_status;
    }


    /** Get all races in the database */
    public static function getRaces()
    {
        $races = DB::table('races as r')
        ->select(
            DB::raw('r.id as race_id'),
            DB::raw('r.race')
        )
            ->orderBy('r.id', 'asc')
            ->get();
        return $races;
    }
}
