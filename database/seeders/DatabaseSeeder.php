<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\CountriesSeeder;
use Database\Seeders\MaritalStatusSeeder;
use Database\Seeders\EducationLevelSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                RolesSeeder::class,
                CountriesSeeder::class,
                GenderSeeder::class,
                EducationLevelSeeder::class,
                MaritalStatusSeeder::class,
                RaceSeeder::class,
            ]
        );
    }
}
