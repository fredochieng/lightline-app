<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gender')->insert(['gender' => 'Male']);
        DB::table('gender')->insert(['gender' => 'Female']);
        DB::table('gender')->insert(['gender' => 'Other']);
    }
}
