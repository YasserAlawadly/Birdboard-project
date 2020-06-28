<div class="bg-white p-5 rounded-lg shadow flex flex-col mt-3">
    <h3 class="font-normal text-xl py-4 mb-3 -ml-5 border-l-4 border-blue-300 pl-4">
        Invite User
    </h3>

    <form action="{{ $project->path() . '/invitations' }}" method="post">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="border border-gray-500 rounded w-full py-2 px-3"
                   placeholder="Email address">
        </div>

        <button type="submit"
                class="bg-blue-400 text-white rounded-lg py-1 px-5 hover:bg-blue-500 text-sm">
            Invite
        </button>
    </form>

    @include('projects.errors' , ['bag' => 'invitations'])
</div>
