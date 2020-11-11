<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super-admin:create';

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
        $email = $this->ask('Adresse email ', 'czn.guillaume@gmail.com');

        if(User::where('email', $email)->exists()) {
            $this->error('Un utilisateur existe déjà avec cet email');
            exit();
        }

        $password = $this->ask('Mot de passe ');

        $hashed_password = Hash::make($password);

        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => $email,
            'password' => $hashed_password,
        ]);
        $user->assignRole('super-admin');

        $this->info('Le compte super-admin a bien été crée');

        return 0;
    }
}
