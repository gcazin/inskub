<?php

namespace Tests\Feature;

use App\Jobs\SendEmailStudentClassroom;
use App\Models\Classroom;
use App\Models\Professor;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Musonza\Chat\Facades\ChatFacade;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Role
     */
    public Role $testIntermediateRole;

    public Role $testProfessorRole;

    public Role $testSchoolRole;

    public Role $testStudentRole;

    public Permission $testPermissionClassroom;

    public function setUp(): void
    {
        parent::setUp();
        $this->testIntermediateRole = Role::create(['name' => 'intermediate']);
        $this->testSchoolRole = Role::create(['name' => 'school']);
        $this->testStudentRole = Role::create(['name' => 'student']);
        $this->testProfessorRole = Role::create(['name' => 'other']);
        $this->testPermissionClassroom = Permission::create(['name' => 'classroom.*']);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    /**
     * Un utilisateur peut voir la page projet
     *
     * @return void
     */
    public function test_can_view_projects_index()
    {
        $user = User::factory()->create();

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
        $user = User::factory()->create();
        $project = factory(Project::class)->create([
            'user_id' => $user->id
        ]);

        $this
            ->be($user)
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
        $user = User::factory()->create();
        $participant = User::factory()->create();

        $project = factory(Project::class)->create();

        $project->addParticipant($participant->id);


        $this
            ->actingAs($user)
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
        $user = User::factory()->create();
        $user->assignRole($this->testIntermediateRole);

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
        $user = User::factory()->create();
        $user->assignRole($this->testIntermediateRole);

        $participants = User::factory()->count(3)->create()->map->only('id');

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
     * @return void
     */
    public function test_can_create_classroom_project_when_user_is_professor()
    {
        Mail::fake();
        Mail::assertNothingSent();

        $user = User::factory()->create();
        $user->assignRole('school');

        $classroom = Classroom::factory()->create();
        Student::factory()->count(5)->create();
        $professor = Professor::factory()->create();

        $participants = $classroom->students->map(function ($participant) {
            return $participant->id;
        });

        $this->be($professor->user)->post(route('project.store'), [
            'title' => 'Projet',
            'description' => $this->faker->realText(50),
            'deadline' => now()->format('d/m/Y'),
            'private' => 1,
            'user_id' => $professor->id,
            'participants' => $participants
        ]);

        Bus::fake();
        foreach($participants as $participant) {
            SendEmailStudentClassroom::dispatch(Student::find($participant), Project::find(1), auth()->user());
        }
        Bus::assertDispatchedTimes(SendEmailStudentClassroom::class, 5);

        $this
            ->assertDatabaseHas('projects', [
                'title' => 'Projet'
            ])
            ->assertEquals(5, Project::find(1)->participants->count());
    }

    public function test_cant_create_classroom_project_when_user_is_not_a_professor()
    {
        $user = User::factory()->create();
        $user->assignRole($this->testIntermediateRole);

        $school = User::factory()->create();
        $school->assignRole($this->testSchoolRole);

        $classroom = Classroom::factory()->create();
        Student::factory()->count(5)->create();

        $participants = $classroom->students->map(function ($participant) {
            return $participant->id;
        });

        $this->be($user)->post(route('project.store'), [
            'title' => 'Projet',
            'description' => $this->faker->realText(50),
            'deadline' => now()->format('d/m/Y'),
            'private' => 1,
            'user_id' => $user->id,
            'participants' => $participants
        ]);

        Bus::fake();
        Bus::assertNotDispatched(SendEmailStudentClassroom::class);

        $conversation = ChatFacade::conversations()->setParticipant(User::find($user->id))->get();

        $this
            ->assertDatabaseHas('projects', [
                'title' => 'Projet'
            ])
            ->assertDatabaseHas('chat_conversations', [
                'id' => 1
            ])
            ->assertEquals(1, $conversation->count());
    }
}
