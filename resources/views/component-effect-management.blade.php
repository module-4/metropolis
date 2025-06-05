<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Component effect management
            </x-slot:title>
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4 ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 gap-y-6">
                @forelse($data as $simComponent)
                    <x-component-effect-card :simComponent="$simComponent"/>
                @empty
                    <p class="text-sm text-gray-500 italic mt-2">
                        No Components found...
                    </p>
                @endforelse
            </div>
            <div class="m-4">
                {{ $data->links() }}
            </div>
        </x-card>
    </div>
</x-dashboard-layout>
