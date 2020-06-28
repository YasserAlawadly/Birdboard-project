@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-600 text-sm font-normal"><a href="/projects">My Projects</a> / {{ $project->title }}</p>
            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img src="{{ gravatar_ulr($member->email) }}" alt="{{ $member->name }}"
                         class="rounded-full w-8 mr-2">
                @endforeach

                <img src="{{ gravatar_ulr($project->owner->email) }}" alt="{{ $project->owner->name }}"
                     class="rounded-full w-8 mr-2">

                <a href="{{ $project->path() . '/edit' }}"
                   class="bg-blue-400 text-white rounded-lg py-1 px-5 hover:bg-blue-500 text-sm ml-4">Edit
                    Project</a>
            </div>

        </div>

    </header>
    <main>
        <div class="lg:flex -mx-3">

            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-600 font-normal mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="bg-white p-5 rounded-lg shadow mb-3">
                            <form action="{{ $task->path() }}" method="post">
                                @csrf
                                @method('PATCH')

                                <div class="flex">
                                    <input name="body" type="text" value="{{ $task->body }}"
                                           class="w-full {{ $task->completed ? 'text-gray-500' : '' }}">
                                    <input name="completed" type="checkbox"
                                           onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>

                            </form>
                        </div>
                    @endforeach

                    <div class="bg-white p-5 rounded-lg shadow mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="post">
                            @csrf
                            <input placeholder="Add new task.." class="w-full" name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-gray-600 font-normal mb-3">General notes</h2>
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea name="notes" class="bg-white p-5 rounded-lg shadow w-full mb-4"
                                  style="min-height: 200px"
                                  placeholder="Type anything you want..">{{ $project->notes }}</textarea>
                        <button type="submit"
                                class="bg-blue-400 text-white rounded-lg py-1 px-5 hover:bg-blue-500 text-sm">Save
                        </button>
                    </form>

                    @include('projects.errors')

                </div>
            </div>

            <div class="lg:w-1/3 px-3 lg:py-8">
                @include('projects.card')

                @include('projects.activity.card')

                @can('manage' , $project)
                    @include('projects.invite')
                @endcan

            </div>

        </div>
    </main>

@endsection
