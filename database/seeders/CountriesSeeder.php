<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert(['country_code' => 'ke', 'country_name' => 'Kenya']);
        DB::table('countries')->insert(['country_code' => 'ug', 'country_name' => 'Uganda']);
        DB::table('countries')->insert(['country_code' => 'tz', 'country_name' => 'Tanzania']);
    }
}
