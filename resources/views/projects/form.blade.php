@csrf

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Title</label>

    <div class="control">
        <input
            type="text"
            class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
            name="title"
            placeholder="My next awesome project" value="{{ $project->title }}" required>
    </div>
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="description">Description</label>

    <div class="control">
                <textarea
                    name="description"
                    rows="10"
                    class="textarea bg-transparent border border-grey-light rounded p-2 text-xs w-full"
                    placeholder="I should start learning piano." required>{{ $project->description }}</textarea>
    </div>
</div>

<div class="field">
    <div class="control">
        <button type="submit" class="bg-blue-400 text-white rounded-lg py-1 px-5 hover:bg-blue-500 text-sm">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}">Cancel</a>
    </div>
</div>

@if($errors->any())
    <div class="field mt-6">
        @foreach($errors->all() as $error)
            <li class="text-sm text-red-500">{{ $error }}</li>
        @endforeach
    </div>
@endif
