<form class="mt-4 mb-2" action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="simulation_id" value="{{ $simulationId }}">
    <div class="flex flex-col">
        <x-label for="content" class="text-sm font-semibold">Add a comment</x-label>
        <div class="flex w-full gap-2">
            <x-input id="content" name="content" placeholder="Comment" type="text" class="grow"></x-input>
            <x-button type="submit" variant="primary">Submit Comment</x-button>
        </div>
        <x-input-error :messages="$errors->all()" class="mt-2" />
    </div>
</form>
