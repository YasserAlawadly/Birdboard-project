<div class="bg-white p-5 rounded-lg shadow flex flex-col" style="height: 200px">
    <h3 class="font-normal text-xl py-4 mb-3 -ml-5 border-l-4 border-blue-300 pl-4">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>
    <p class="text-gray-500 mb-4 flex-1">{{ \Illuminate\Support\Str::limit($project->description ,100) }}</p>

    @can('manage' , $project)
        <footer>
            <form action="{{ $project->path() }}" method="post" class="text-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs">Delete</button>
            </form>
        </footer>
    @endcan
</div>

