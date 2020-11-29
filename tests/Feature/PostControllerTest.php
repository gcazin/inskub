<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->be($user)->post(route('post.create'), [
            'content' => 'Contenu',
            'visibility_id' => 1,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => 'Contenu'
        ]);

        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }

    /**
     * @test
     */
    public function it_can_create_post_with_media()
    {
        Storage::fake('local');

        $user = User::factory()->create();

        $response = $this->be($user)->post(route('post.create'), [
            'content' => 'Contenu',
            'visibility_id' => 1,
            'user_id' => $user->id,
            'media' => $image = UploadedFile::fake()->image('photo.jpg')
        ]);
        Storage::disk('local')->assertExists('posts/' . $image->hashName());

        $this->assertDatabaseHas('posts', [
            'content' => 'Contenu'
        ]);

        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }

    /**
     * @test
     */
    public function it_can_create_post_without_media()
    {
        $user = User::factory()->create();

        $response = $this->be($user)->post(route('post.create'), [
            'content' => 'Contenu',
            'visibility_id' => 1,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => 'Contenu'
        ]);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }

    /**
     * @test
     */
    public function it_can_create_post_in_project()
    {
        $user = User::factory()->create();
        $project = factory(Project::class)->create();

        $response = $this->be($user)->post(route('post.create'), [
            'content' => 'Contenu',
            'visibility_id' => 1,
            'user_id' => $user->id,
            'project_id' => $project->id
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => 'Contenu',
            'project_id' => $project->id,
        ]);

        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }

    /**
     * @test
     */
    public function it_can_create_post_in_project_without_media()
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $project = factory(Project::class)->create();

        $response = $this->be($user)->post(route('post.create'), [
            'content' => 'Contenu',
            'visibility_id' => 1,
            'user_id' => $user->id,
            'media' => $image = UploadedFile::fake()->image('photo.jpg'),
            'project_id' => $project->id
        ]);
        Storage::disk('local')->assertExists('posts/' . $image->hashName());

        $this->assertDatabaseHas('posts', [
            'content' => 'Contenu',
            'project_id' => $project->id
        ]);

        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }

    /**
     * @test
     */
    public function it_can_create_post_without_project_id_and_media()
    {
        $user = User::factory()->create();

        $response = $this->be($user)->post(route('post.create'), [
            'content' => 'Contenu',
            'visibility_id' => 1,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => 'Contenu'
        ]);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }
}
