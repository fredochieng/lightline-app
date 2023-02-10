<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_level')->insert(['education_level' => 'Primary']);
        DB::table('education_level')->insert(['education_level' => 'Secondary']);
        DB::table('education_level')->insert(['education_level' => 'University']);
    }
}
