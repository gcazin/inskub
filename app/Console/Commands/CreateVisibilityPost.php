<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateVisibilityPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visibility-post:create';

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
        $visibilities = [
            'Public' => 'Tout le monde pourra voir votre publication',
            'Abonnés' => 'Votre publication ne sera visible que pour vos abonnés',
            'Privée' => 'Votre publication ne sera visible que par vous'];

        foreach($visibilities as $type => $description) {
            DB::table('visibility_posts')->insert([
                'type' => $type,
                'description' => $description
            ]);
        }
        $this->info('Les visibilités des posts ont été générés.');

        return 0;
    }
}
