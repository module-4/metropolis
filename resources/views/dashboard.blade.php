@php
    use App\Models\ComponentNotification;
    use Illuminate\Support\Collection;
        /** @var Collection<ComponentNotification> $notifications */
@endphp
<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Component creation notifications
            </x-slot:title>
            <x-table>
                <x-slot:thead>
                    <x-table-head>
                        Component
                    </x-table-head>
                    <x-table-head>
                        Category
                    </x-table-head>
                    <x-table-head>
                        Created at
                    </x-table-head>
                </x-slot:thead>
                @forelse($notifications as $notification)
                    <x-table-row>
                        <x-table-data>
                            {{ $notification->component->name }}
                        </x-table-data>
                        <x-table-data>
                            {{ $notification->component->category->name }}
                        </x-table-data>
                        <x-table-data>
                            {{ $notification->created_at->format('d-m-Y H:i') }}
                        </x-table-data>
                    </x-table-row>
                @empty
                    <x-table-row>
                        <x-table-data colspan="3">
                            <p class="text-center text-sm text-bg-foreground">No notifications</p>
                        </x-table-data>
                    </x-table-row>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-dashboard-layout>
