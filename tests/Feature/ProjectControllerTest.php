<?php

namespace Tests\Feature;

use App\Mail\CreatingStudent;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Un utilisateur peut voir la page projet
     *
     * @return void
     */
    public function test_can_view_projects_index()
    {
        $user = factory(User::class)->create();

        $response = $this->be($user)->get(route('project.index'));

        $response->assertStatus(200);
    }

    /**
     * Un utilisateur peut voir la page projet
     *
     * @return void
     */
    public function test_cant_view_projects_index_is_user_is_not_logged()
    {
        $response = $this->get(route('project.index'));

        $response
            ->assertRedirect(route('welcome'))
            ->assertStatus(302);
    }

    /**
     * Un utilisateur peut voir le détail d'un projet
     *
     * @return void
     */
    public function test_can_view_project_index()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create([
            'user_id' => $user->id
        ]);

        $this
            ->actingAs($user)
            ->get(route('project.show', $project->id))
            ->assertStatus(200);
    }

    /**
     * Un utilisateur qui ne participe pas au projet ne peut pas le voir
     *
     * @return void
     */
    public function test_cant_view_project_index_where_user_is_not_participant()
    {
        $user = factory(User::class)->create();
        $participant = factory(User::class)->create();

        $project = factory(Project::class)->create();

        $project->addParticipant($participant->id);

        $this
            ->be($user)
            ->get(route('project.show', $project->id))
            ->assertStatus(403);
    }

    /**
     * Un utilisateur qui ne participe pas au projet ne peut pas le voir
     *
     * @return void
     */
    public function test_can_create_professionnel_project_without_participants()
    {
        $user = factory(User::class)->create([
            'role_id' => 3
        ]);

        $response = $this->actingAs($user)->post(route('project.store'), [
            'title' => $this->faker->title,
            'description' => $this->faker->realText(50),
            'deadline' => now()->format('d/m/Y'),
            'private' => 1,
            'user_id' => $user->id
        ]);

        $response
            ->assertRedirect(route('project.index'))
            ->assertStatus(302);
    }

    /**
     * Un utilisateur peut créer un projet avec des participants
     *
     * @return void
     */
    public function test_can_create_professionnel_project_with_participants()
    {
        $user = factory(User::class)->create([
            'role_id' => 3
        ]);

        $participants = factory(User::class, 3)->create()->map->only('id');

        $response = $this->actingAs($user)->post(route('project.store'), [
            'title' => $this->faker->title,
            'description' => $this->faker->realText(50),
            'deadline' => now()->format('d/m/Y'),
            'private' => 1,
            'user_id' => $user->id,
            'participants' => $participants->flatten()
        ]);

        $response
            ->assertRedirect(route('project.index'))
            ->assertStatus(302);
    }

    /**
     * Un professeur peut créer une salle de classe avec des participants
     *
     * TODO: A changer pour laisser cette possibilité à l'administrateur, à repenser
     *
     * @return void
     */
    public function test_can_create_classroom_project_when_user_is_professor()
    {
        Mail::fake();

        Mail::assertNothingSent();

        $user = factory(User::class)->create([
            'role_id' => 4
        ]);

        $participants = json_encode([0 => ['value' => 'test@test.fr'], 1 => ['value' => 'test2@test.fr']]);

        $response = $this->actingAs($user)->post(route('project.store'), [
            'title' => $this->faker->title,
            'description' => $this->faker->realText(50),
            'deadline' => now()->format('d/m/Y'),
            'private' => 1,
            'user_id' => $user->id,
            'participants' => $participants
        ]);

        foreach(json_decode($participants) as $participant) {
            Mail::assertSent(CreatingStudent::class, function ($mail) use ($participant) {
                return $mail->hasTo($participant->value);
            });
        }

        $response
            ->assertRedirect(route('project.index'))
            ->assertStatus(302);
    }

    public function test_can_create_classroom_project_when_user_is_not_a_professor()
    {
        $user = factory(User::class)->create([
            'role_id' => 3
        ]);

        $participants = json_encode([0 => ['value' => 'test@test.fr'], 1 => ['value' => 'test2@test.fr']]);

        $response = $this->actingAs($user)->post(route('project.store'), [
            'title' => $this->faker->title,
            'description' => $this->faker->realText(50),
            'deadline' => now()->format('d/m/Y'),
            'private' => 1,
            'user_id' => $user->id,
            'participants' => $participants
        ]);

        $response
            ->assertSessionHasErrors('private')
            ->assertStatus(403);
    }
}
