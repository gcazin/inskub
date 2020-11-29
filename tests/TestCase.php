<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $testUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->artisan('inskub:setup')
            ->expectsConfirmation('Voulez-vous créer un super-utilisateur?')
            ->run();
    }

    /**
     * Permet de générer un utilisateur
     *
     * @param array|null $attributs
     */
    public function createUser(array $attributs = null)
    {
        $this->testUser = $attributs !== null ? User::factory()->create($attributs) : User::factory()->create();
    }

    public function errors()
    {
        return session('errors');
    }
}
