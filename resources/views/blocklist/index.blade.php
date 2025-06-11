<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Placement restrictions
            </x-slot:title>
            <x-slot:buttons>
                <x-button :isLink="true" href="{{ route('blocklist.create') }}">
                    New restriction
                    <x-tabler-plus aria-hidden="true" class="-mr-1"/>
                </x-button>
            </x-slot:buttons>

            @if(count($blocklist) > 0)
                <div class="flex flex-col bg-white drop-shadow-sm drop-shadow-gray-100 rounded-sm">
                    @foreach($blocklist as $blocklistEntry)
                        <div class="flex justify-center border border-border border-b-0 only:rounded-sm first:rounded-t-sm last:rounded-b-sm last:border-b overflow-hidden">
                            <div class="flex flex-1/3 bg-red-200">
                                <div class="flex bg-white grow">
                                    <p class="m-3 mt-auto mb-auto ml-auto">{{ $blocklistEntry->component->name }}</p>
                                </div>
                                <x-triangle class="inline-block h-10 text-white"/>
                            </div>
                            <div class="flex justify-center items-center bg-red-200 grow">
                                <x-tabler-x class="text-red-500"/>
                            </div>
                            <div class="flex flex-1/3 bg-red-200">
                                <x-triangle class="inline-block h-10 text-white rotate-180"/>
                                <div class="flex bg-white grow">
                                    <p class="m-3 mt-auto mb-auto">{{ $blocklistEntry->blockedComponent->name }}</p>
                                </div>
                                <form action="{{
                                    route('blocklist.destroy', [
                                        'componentId' => $blocklistEntry->component->id,
                                        'blockedComponentId' => $blocklistEntry->blockedComponent->id
                                    ])
                                }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="flex justify-center items-center h-full p-1.5 pl-3 pr-3 bg-white text-danger not-disabled:cursor-pointer"
                                            aria-label="Delete restriction for '{{ $blocklistEntry->component->name }}' and '{{ $blocklistEntry->blockedComponent->name }}'"
                                            title="Delete restriction for '{{ $blocklistEntry->component->name }}' and '{{ $blocklistEntry->blockedComponent->name }}'">
                                        <x-tabler-trash aria-hidden="true"/>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No restrictions set.</p>
            @endif
        </x-card>
    </div>
</x-dashboard-layout>
