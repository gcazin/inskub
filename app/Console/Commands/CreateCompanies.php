<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:create';

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
        $companies = [
            'Axa',
            'CNP Assurances',
            'Predica',
            'Allianz',
            'Groupama',
            'Generali',
            'BNP Paribas',
            'Crédit mutuel',
            'Aviva',
            'La Mondiale',
            'Macif',
            'Swiss Life',
            'MMA',
            'MAAF',
            'Natixis',
            'MAIF',
            'GMF',
            'SMA',
            'Suravenir',
            'Scor',
            'MAE',
            'AG2R La Mondiale',
            'PRO BTP',
            'Klesia',
            'Malakoff Médéric'
        ];

        foreach($companies as $company) {
            DB::table('companies')->insert([
                'name' => $company,
            ]);
        }

        $this->info('Les compagnies ont été générés.');

        return 0;
    }
}
