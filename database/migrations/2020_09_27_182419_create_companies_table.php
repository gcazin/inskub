<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->timestamps();
        });

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
