<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responses')->insert([
            'name' => 'Investigating'
        ]);

        DB::table('responses')->insert([
            'name' => 'Identified'
        ]);

        DB::table('responses')->insert([
            'name' => 'Monitoring'
        ]);
        
        DB::table('responses')->insert([
            'name' => 'Resolved'
        ]);
    }
}
