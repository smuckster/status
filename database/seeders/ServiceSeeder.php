<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Email',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 1,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'SFTP',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 2,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Background Jobs',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 3,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Database Proxy',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 4,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Big Blue Button',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 5,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Moodle',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 1,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Moodle Workplace',
            'default_status_id' => 1,
            'current_status_id' => 2,
            'sort_order' => 2,
            'created_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Totara',
            'default_status_id' => 1,
            'current_status_id' => 1,
            'sort_order' => 3,
            'created_at' => now()
        ]);
    }
}
