<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class EntryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIfUserCanStartWorkingHours()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->postJson('/api/projects/' . $project->id . '/start');
        $response->assertStatus(200);
    }

    public function testIfUserCannotStartOtherUserWorkingHours()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherUser = factory(User::class)->create();
        $response = $this->actingAs($otherUser)->postJson('/api/projects/' . $project->id . '/start');
        $response->assertStatus(403);
    }

    public function testIfUserCanStopWorkingHours()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id . '/stop');
        $response->assertStatus(200);
    }

    public function testIfUserCannotStopOtherUserWorkingHours()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherUser = factory(User::class)->create();
        $response = $this->actingAs($otherUser)->patchJson('/api/projects/' . $project->id . '/stop');
        $response->assertStatus(403);
    }

    public function testIfUserStartAProjectTwoTimes()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherProject = factory(Project::class)->create();
        $response = $this->actingAs($user)->postJson('/api/projects/' . $project->id . '/start');
        $response->assertJson([
            "status"=> "success",
            "message"=> "Project started successfully"
        ]);
        $response = $this->actingAs($user)->postJson('/api/projects/' . $project->id . '/start');
        $response->assertJson([
            "status"=> "success",
            "message"=> "Project is already started"
        ]);
    }

    public function testIfUserStopAProjectTwoTimes()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $this->actingAs($user)->postJson('/api/projects/' . $project->id . '/start');
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id . '/stop');
        $response->assertJson([
            "status"=> "success",
            "message"=> "Project stopped successfully"
        ]);
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id . '/stop');
        $response->assertJson([
            "status"=> "success",
            "message"=> "Project is already stopped"
        ]);
    }

    public function testIfUserStartAProjectWhileUserHasAnotherStartedProjectOldProjectShouldBeStop()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $otherProject = factory(Project::class)->create();
        $this->actingAs($user)->postJson('/api/projects/' . $project->id . '/start');
        $this->actingAs($user)->postJson('/api/projects/' . $otherProject->id . '/start');
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id . '/stop');
        $response->assertJson([
            "status"=> "success",
            "message"=> "Project is already stopped"
        ]);
    }

    public function testIf()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        // 'working_time_seconds', 'total_entries', 'is_stopped'
        $otherProject = factory(Project::class)->create();
        $this->actingAs($user)->postJson('/api/projects/' . $project->id . '/start');
        $this->actingAs($user)->postJson('/api/projects/' . $otherProject->id . '/start');
        Log::info('========= Test Started');
        // sleep(2);
        $response = $this->actingAs($user)->patchJson('/api/projects/' . $project->id . '/stop');
        // sleep(2);
        // dd($p1);
        $pro1 = Project::find(1);
        Log::info($pro1);
        Log::info('========= Test Ended');
        dd($pro1);
        // dd($p1->entries);
        $response->assertJson([
            "status"=> "success",
            "message"=> "Project is already stopped"
        ]);
    }
}
