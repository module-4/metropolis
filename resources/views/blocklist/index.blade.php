<x-dashboard-layout>
    <div class="flex items-center justify-center grow max-h-full">
        <x-card class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <x-slot name="title">
                Placement restrictions
            </x-slot>

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
                                    <button type="submit" class="flex justify-center items-center h-full p-1.5 pl-3 pr-3 bg-white text-danger not-disabled:cursor-pointer">
                                        <x-tabler-trash />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No restrictions set.</p>
            @endif

            <div class="flex">
                <x-button :isLink="true" href="{{ route('blocklist.create') }}" class="ml-auto mt-3">New restriction</x-button>
            </div>
        </x-card>
    </div>
</x-dashboard-layout>
