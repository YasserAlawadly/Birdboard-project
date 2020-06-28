<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function a_user_has_projects()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(collection::class , $user->projects);
    }

    /** @test */

    public function a_user_has_accessible_projects()
    {
        $yasser = $this->signIn();

        $project = ProjectFactory::ownedBy($yasser)->create();

        $ali = factory(User::class)->create();
        ProjectFactory::ownedBy($ali)->create()->invite($yasser);

        $this->assertCount(2 , $yasser->allProjects());
    }
}
