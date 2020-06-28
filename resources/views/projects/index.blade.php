@extends('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-gray-600 text-sm font-normal">My Projects</h2>

            <a href="/projects/create" class="bg-blue-400 text-white rounded-lg py-1 px-5 hover:bg-blue-500 text-sm"
               @click.prevent="$modal.show('new-project')">
                New Project
            </a>
        </div>

    </header>

    <main class="lg:flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No Projects yet!</div>
        @endforelse
    </main>

    <new-project-modal></new-project-modal>

@endsection
