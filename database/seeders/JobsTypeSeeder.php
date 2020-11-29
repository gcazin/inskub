<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['CDI', 'CDD', 'Interim', 'Stage', 'Alternance'];

        foreach($types as $type) {
            DB::table('job_type')->insert([
                'title' => $type,
                'description' => ''
            ]);
        }
    }
}
