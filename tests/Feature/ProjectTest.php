<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatingProjectWithExistingNameFails()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)->postJson('/api/projects', ['name' => $project->name]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testCannotUpdateProjectToNameOtherProjectHas()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherProject = factory(Project::class)->create();
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id, [
            'name' => $otherProject->name
        ]);

        $response->assertStatus(422);
    }

    public function testCanUpdateProjectToKeepSameName()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id, [
            'name' => $project->name,
        ]);
        
        $response->assertStatus(200);
    }

    public function testUserViewItsOwnProjects()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->getJson('/api/projects');
        $response->assertStatus(200);
    }

    public function testUserViewItsOwnProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->getJson('/api/projects/' . $project->id);
        $response->assertStatus(200);
    }

    public function testUserCannotViewOtherUsersProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherUser = factory(User::class)->create();
        $response = $this->actingAs($otherUser)->getJson('/api/projects/' . $project->id);
        $response->assertStatus(403);
    }

    public function testUserCanUpdateItsOwnProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id, [
            'name' => 'bla bla'
        ]);
        $response->assertStatus(200);
    }

    public function testUserCannotUpdateOtherUsersProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherUser = factory(User::class)->create();
        $response = $this->actingAs($otherUser)->patchJson('/api/projects/' . $project->id, [
            'name' => 'bla bla'
        ]);
        $response->assertStatus(403);
    }

    public function testUserCanDeleteItsOwnProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->deleteJson('/api/projects/' . $project->id);
        $response->assertStatus(200);
    }

    public function testUserCannotDeleteOtherUsersProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherUser = factory(User::class)->create();
        $response = $this->actingAs($otherUser)->deleteJson('/api/projects/' . $project->id);
        $response->assertStatus(403);
    }

    
}
