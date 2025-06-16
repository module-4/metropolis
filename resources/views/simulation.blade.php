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
