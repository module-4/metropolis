<x-dashboard-layout>
    <div class="flex items-center justify-center grow max-h-full">
        <x-card class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <x-slot name="title">
                Create new placement restriction
            </x-slot>

            <form action="{{ route('blocklist.store') }}" method="POST" enctype="multipart/form-data" id="component-blocklist-create-form">
                @csrf

                <div class="flex justify-center border border-border border-b-0 only-of-type:rounded-sm first-of-type:rounded-t-sm last-of-type:rounded-b-sm last-of-type:border-b overflow-hidden">
                    <div class="flex flex-1/3 bg-red-200">
                        <div class="flex bg-white grow">
                            <x-select name="component_id" id="component_id" class="m-3 mt-auto mb-auto ml-auto w-min border-0">
                                @foreach ($components as $simComponent)
                                    <option value="{{ $simComponent->id }}">
                                        {{ $simComponent->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-triangle class="inline-block h-10 text-white"/>
                    </div>
                    <div class="flex justify-center items-center bg-red-200 grow">
                        <x-tabler-x class="text-red-500"/>
                    </div>
                    <div class="flex flex-1/3 bg-red-200">
                        <x-triangle class="inline-block h-10 text-white rotate-180"/>
                        <div class="flex bg-white grow">
                            <x-select name="blocked_component_id" id="blocked_component_id" class="m-3 mt-auto mb-auto mr-auto w-min border-0">
                                @foreach ($components as $simComponent)
                                    <option value="{{ $simComponent->id }}">
                                        {{ $simComponent->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>
            </form>

            <x-input-error :messages="$errors->get('component_id')"/>
            <x-input-error :messages="$errors->get('blocked_component_id')"/>

            <div class="flex items-center gap-1 mt-3">
                <a href="{{ route('blocklist.index') }}" class="text-black pl-4 pr-4 text-sm not-disabled:cursor-pointer ml-auto">Back</a>
                <x-button form="component-blocklist-create-form" variant="primary" type="submit" class="not-disabled:cursor-pointer">
                    Create restriction
                </x-button>
            </div>
        </x-card>
    </div>
</x-dashboard-layout>
