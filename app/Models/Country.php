<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    use HasFactory;

    protected $tableName = 'countries';

    public static function getCountries()
    {
        /** Get all countries in the database */
        $countries = DB::table('countries as c')
            ->select(
                DB::raw('c.country_code'),
                DB::raw('c.countrY_name')
            )
            ->orderBy('c.country_name', 'asc')
            ->get();
        return $countries;
    }
}
