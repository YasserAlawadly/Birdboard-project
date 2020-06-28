<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = factory(Project::class)->create();

        $this->assertInstanceOf('App\User' , $project->owner);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = factory(Project::class)->create();

        $task = $project->addTask('Test Task');

        $this->assertCount(1,$project->tasks);
        $this->assertTrue($project->tasks->contains($task));

//        $this->assertInstanceOf(collection::class, $project->tasks);
    }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = factory(Project::class)->create();

        $project->invite($user = factory(User::class)->Create());

        $this->assertTrue($project->members->contains($user));
    }
}
