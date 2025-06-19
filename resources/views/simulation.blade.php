<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Simulation
            </x-slot:title>
            <x-slot:buttons>
                <x-button :isLink="true" href="{{ route('reports.show') }}">
                    View simulation report
                    <x-tabler-file aria-hidden="true" class="-mr-1"/>
                </x-button>
            </x-slot:buttons>
            <x-sim-controlbar :events="$events" class="mb-6"></x-sim-controlbar>
            <div class="flex flex-col gap-2 lg:flex-row justify-center">
                <div class="flex flex-col gap-2 grow max-w-[768px]">
                    <x-sim-grid :components="$simulationComponents"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-sim-delete-area id="delete-area">Drop component to remove</x-sim-delete-area>
                    <x-sim-effects-list :effects="$effects"/>
                    <x-sim-components-library :categories="$categories"/>
                </div>
            </div>
            <x-comment-section-form :simulation-id="$simulation->id" :errors="$errors"/>
            <div class="max-h-[28rem] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Comments</h2>
                </div>
                <!-- Comments List -->
                @foreach ($simulation->comments()->orderBy('created_at', 'desc')->get() as $comment)
                    <div class="grid grid-cols-[1fr_4fr_1fr] gap-4 border-b py-2 w-full">
                        <!-- User column -->
                        <div class="text-gray-700 font-medium truncate">
                            User {{ $comment->user_id }}
                        </div>

                        <!-- Comment content -->
                        <div class="text-gray-900 break-words overflow-hidden">
                            {{ $comment->content }}
                        </div>

                        <!-- Timestamp + Delete -->
                        <div class="text-gray-500 text-sm text-right">
                            <div>{{ $comment->created_at->setTimezone('Europe/Amsterdam')->format('d-m-Y H:i') }}</div>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-xs mt-1">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                @if ($simulation->comments->isEmpty())
                    <p class="text-gray-500 mt-4">No comments yet.</p>
                @endif
            </div>
        </x-card>
    </div>

</x-dashboard-layout>
<x-modal id="simulation-blocklist-warning">
    <x-slot:icon>
        <x-tabler-alert-hexagon aria-hidden="true" class="w-8 h-8"/>
    </x-slot:icon>
    <x-slot:heading>Condition Enforcement</x-slot:heading>
    <x-slot:description>Prohibited condition detected</x-slot:description>
    <p>
        The component could not be placed because it is prohibited from being placed directly adjacent to the following
        component(s):
    </p>
    <ul class="mt-2 list-disc list-inside">
        <li>Component 1</li>
        <li>Component 2</li>
        <li>Component 3</li>
    </ul>
    <p class="italic text-danger text-sm mt-5">
        Dismissing this warning will result in the component being forcefully placed, disregarding any placement
        restrictions that have been set, for this occurance.
    </p>
    <x-slot:footer>
        <form>
            <input type="hidden" name="componentId" value=""/>
            <input type="hidden" name="x" value=""/>
            <input type="hidden" name="y" value=""/>
            <x-button type="submit" name="dismiss" variant="danger">Dismiss</x-button>
            <x-button type="submit" name="accept">Accept</x-button>
        </form>
    </x-slot:footer>
</x-modal>
