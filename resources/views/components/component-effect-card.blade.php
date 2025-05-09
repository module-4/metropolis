<div class="w-full md:w-1/2 px-2 my-2">
    <div class="bg-white shadow-md rounded-lg p-6 max-h-[30vh] overflow-auto">
        <h1 class="text-2xl font-bold mb-4">{{ $component->name }}</h1>
        <table class="w-full">
            @foreach($component->effects as $effect)
                <x-component-effect-row
                :effect="$effect"
                >

                </x-component-effect-row>
            @endforeach
        </table>
    </div>
</div>
