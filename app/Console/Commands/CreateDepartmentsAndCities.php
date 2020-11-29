<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDepartmentsAndCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'localisation:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Génération des villes
        $this->info('Génération des villes en cours...');
        $cities = file_get_contents(base_path('database/cities.json'));
        $json = json_decode($cities, true, 512, JSON_THROW_ON_ERROR);

        $bar = $this->output->createProgressBar(count($json));
        $bar->start();

        $startTime = microtime(true);
        foreach($json as $key => $value) {
            $bar->advance();

            if(app()->environment() === 'local' || app()->environment() === 'testing' && $key === 500) {
                break;
            }

            (new City())->create($value);
        }
        $endTime = microtime(true);

        $bar->finish();

        $this->line('');
        $this->info('Les villes ont été générés en ' . number_format(($endTime - $startTime), 0) . 's.');

        // Génération des départements
        $departments = file_get_contents(base_path('database/departments.json'));
        $json = json_decode($departments, true, 512, JSON_THROW_ON_ERROR);
        DB::table('departments')->insert($json);
        $this->info('Les départements ont été générés.');

        return 0;
    }
}
