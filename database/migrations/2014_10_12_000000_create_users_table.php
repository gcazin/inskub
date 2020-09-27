<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->default('user.jpg');
            $table->integer('department')->nullable();
            $table->integer('tel')->nullable();
            $table->integer('adresse')->nullable();
            $table->integer('company')->nullable();
            $table->longText('about')->nullable();

            $table->string('mollie_customer_id')->nullable();
            $table->string('mollie_mandate_id')->nullable();
            $table->decimal('tax_percentage', 6, 4)->default(0);
            $table->dateTime('trial_ends_at')->nullable();
            $table->text('extra_billing_information')->nullable();


            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });

        $roles = ['admin', 'salarie', 'entreprise', 'ecole', 'etudiant'];

        $i = 1;
        foreach($roles as $role) {
            DB::table('users')->insert([
                'role_id' => $i++,
                'last_name' => $role,
                'first_name' => $role,
                'email' => ''.$role.'@'.$role.'.fr',
                'password' => Hash::make('secret'),
                'avatar' => 'https://randomuser.me/api/portraits/'.array_rand(array_flip(['men', 'women']), 1).'/'.random_int(1,99).'.jpg'
            ]);
        }

        DB::table('users')->insert([
            'role_id' => 2,
            'last_name' => 'invite',
            'first_name' => 'invite',
            'email' => 'invite@invite.fr',
            'password' => Hash::make('invite'),
            'avatar' => 'https://randomuser.me/api/portraits/'.array_rand(array_flip(['men', 'women']), 1).'/'.random_int(1,99).'.jpg'
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'last_name' => 'jury1',
            'first_name' => 'jury1',
            'email' => 'jury1@jury.fr',
            'password' => Hash::make('jury1'),
            'avatar' => 'https://randomuser.me/api/portraits/'.array_rand(array_flip(['men', 'women']), 1).'/'.random_int(1,99).'.jpg'
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'last_name' => 'jury2',
            'first_name' => 'jury2',
            'email' => 'jury2@jury.fr',
            'password' => Hash::make('jury2'),
            'avatar' => 'https://randomuser.me/api/portraits/'.array_rand(array_flip(['men', 'women']), 1).'/'.random_int(1,99).'.jpg'
        ]);

        for($i = 1; $i <= 4; $i++) {
            DB::table('users')->insert([
                'role_id' => 2,
                'last_name' => 'invite'.$i,
                'first_name' => 'invite'.$i,
                'email' => 'invite'.$i.'@invite.fr',
                'password' => Hash::make('invite'.$i),
                'avatar' => 'https://randomuser.me/api/portraits/'.array_rand(array_flip(['men', 'women']), 1).'/'.random_int(1,99).'.jpg'
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
