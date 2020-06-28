<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('manage' , $project);

        request()->validateWithBag('invitations' , [
            'email' => 'required|exists:users,email'
        ] , [
            'email.exists' => 'The user you are inviting must have valid Birdboard account.'
        ]);

        $user = User::whereEmail(\request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
