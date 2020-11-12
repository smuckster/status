<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'Operational',
            'color' => '#009933'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Degraded Performance',
            'color' => '#ff9900'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Outage',
            'color' => '#99000'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Maintenance',
            'color' => '#ffcc00'
        ]);
    }
}
