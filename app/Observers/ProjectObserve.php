<?php

namespace App\Observers;

use App\Project;

class ProjectObserve
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $project->recordActivity('created_project');
    }


    public function updating(Project $project)
    {
        $project->oldAttributes = $project->getOriginal();
    }


    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $project->recordActivity('updated_project');
    }



}
