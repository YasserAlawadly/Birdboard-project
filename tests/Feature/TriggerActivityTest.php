<?php

namespace Tests\Feature;

use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function create_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);

        tap($project->activity->last() , function ($activity) {
            $this->assertEquals('created_project' , $activity->description);

            $this->assertNull($activity->changes);
        });
    }

    /** @test */

    public function updating_a_project()
    {
        $project = ProjectFactory::create();
        $originalTitle = $project->title;

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

        tap($project->activity->last() , function ($activity) use ($originalTitle){
            $this->assertEquals('updated_project' , $activity->description);

            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'changed']
            ];

            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */

    public function creating_new_task()
    {
        $project = ProjectFactory::create();

        $project->addTask('test task');

        $this->assertCount(2, $project->activity);

        tap($project->activity->last() , function ($activity){
            $this->assertEquals('created_task' , $activity->description);
            $this->assertInstanceOf(Task::class , $activity->subject);
            $this->assertEquals('test task' , $activity->subject->body);
        });

    }

    /** @test */

    public function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path() , [
           'body' => 'foobar',
           'completed' => true
        ]);

        $this->assertCount(3, $project->activity);
        tap($project->activity->last() , function ($activity){
            $this->assertEquals('completed_task' , $activity->description);
            $this->assertInstanceOf(Task::class , $activity->subject);
        });
    }

    /** @test */

    public function incomplete_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path() , [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $project->refresh();

        $this->assertCount(4, $project->activity);

        $this->assertEquals('InCompleted_task' , $project->activity->last()->description);
    }

    /** @test */

    public function deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activity);
        $this->assertEquals('deleted_task' , $project->activity[2]->description);
    }
}
