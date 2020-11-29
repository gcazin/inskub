<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupInskubCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inskub:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permet de générer les éléments de base du site';

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
        $this->line('');
        $this->info('Commencement de la génération...');

        // Rôles et permissions
        $this->call('roles-permissions:create');

        // Visibilité des publications
        $this->call('visibility-post:create');

        // Compétences pour les utilisateurs
        $this->call('user-skills:create');

        // Département et villes
        $this->call('localisation:create');

        // Compagnies
        $this->call('companies:create');

        if ($this->confirm('Voulez-vous créer un super-utilisateur?', true)) {
            $this->call('super-admin:create');
        }

        $this->line('');
        $this->info('Génération terminée');
        $this->line('');

        return 0;
    }
}
