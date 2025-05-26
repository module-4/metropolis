<x-dashboard-layout>
    <div class="flex items-center justify-center grow max-h-full">
        <x-card class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <x-slot name="title">
                Simulation view
            </x-slot>
            <div class="flex flex-col">
                <div class="
                    grid
                    grid-cols-1
                    gap-2

                    min-md:grid-cols-2
                    min-lg:grid-cols-5

                    min-xl:w-full
                    min-xl:max-w-[1000px]
                    min-xl:mx-auto
                ">
                    <x-sim-grid :components="$simulationComponents" />
                    <x-sim-effects-list :effects="$effects"/>
                    <x-sim-components-library :categories="$categories"/>
                </div>
            </div>
        </x-card>
    </div>
</x-dashboard-layout>
<x-modal id="simulation-blocklist-warning">
    <x-slot:icon>
        <x-tabler-alert-hexagon class="w-8 h-8"/>
    </x-slot:icon>
    <x-slot:heading>Condition Enforcement</x-slot:heading>
    <x-slot:description>Prohibited condition detected</x-slot:description>
    <p>
        The component could not be placed because it is prohibited from being placed directly adjacent to the following component(s):
    </p>
    <ul class="mt-2 list-disc list-inside">
        <li>Component 1</li>
        <li>Component 2</li>
        <li>Component 3</li>
    </ul>
    <p class="italic text-danger text-sm mt-5">
        Dismissing this warning will result in the component being forcefully placed, disregarding any placement restrictions that have been set, for this occurance.
    </p>
    <x-slot:footer>
        <form>
            <input type="hidden" name="componentId" value="" />
            <input type="hidden" name="x" value="" />
            <input type="hidden" name="y" value="" />
            <x-button type="submit" name="dismiss" variant="danger">Dismiss</x-button>
            <x-button type="submit" name="accept">Accept</x-button>
        </form>
    </x-slot:footer>
</x-modal>
