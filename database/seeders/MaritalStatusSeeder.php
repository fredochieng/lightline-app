<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_status')->insert(['marital_status' => 'Single']);
        DB::table('marital_status')->insert(['marital_status' => 'Married']);
        DB::table('marital_status')->insert(['marital_status' => 'Divorced']);
    }
}
