<x-dashboard-layout>
    <div class="flex flex-col">
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4 ">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex flex-wrap content-start">
            @foreach($data as $simComponent)
                <x-component-effect-card
                    :simComponent="$simComponent"
                >
                </x-component-effect-card>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
