<?php

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
            DB::table('jobs_type')->insert([
                'title' => $type,
                'description' => ''
            ]);
        }
    }
}
