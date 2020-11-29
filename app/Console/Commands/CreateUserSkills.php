<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateUserSkills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-skills:create';

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
        $skills = [
            'Accidents',
            'Corps de véhicules terrestres',
            'Corps de véhicules ferroviaires',
            'Corps de véhicules aériens',
            'Corps de véhicules maritimes, lacustres et fluviaux',
            'Marchandises transportées par voie maritime ',
            'Marchandises transportées par voie terrestres et fluviales',
            'Incendie et éléments naturels',
            'Autres dommages aux biens',
            'Responsabilité civile véhicules terrestres automoteurs',
            'Responsabilité civile véhicules aériens',
            'Responsabilité civile véhicules maritimes, lacustres et fluviaux',
            'Responsabilité civile générale',
            'Protection juridique',
            'Assistance',
            'Assurances liées à des fonds d\'investissement'
        ];

        foreach($skills as $skill) {
            DB::table('skills')->insert([
                'title' => $skill
            ]);
        }

        $this->info('Les compétences des utilisateurs ont été générés.');

        return 0;
    }
}
