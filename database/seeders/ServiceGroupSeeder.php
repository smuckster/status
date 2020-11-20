<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_groups')->insert([
            'name' => 'Learning Management Systems',
            'sort_order' => 1,
            'created_at' => now()
        ]);

        DB::table('service_group_assignments')->insert([
            'service' => 6,
            'service_group' => 1,
        ]);

        DB::table('service_group_assignments')->insert([
            'service' => 7,
            'service_group' => 1,
        ]);

        DB::table('service_group_assignments')->insert([
            'service' => 8,
            'service_group' => 1,
        ]);
    }
}
