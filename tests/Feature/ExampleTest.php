<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = factory(User::class)->make();

        $response = $this->be($user)->get('/');

        $response->assertStatus(200);
    }
}
