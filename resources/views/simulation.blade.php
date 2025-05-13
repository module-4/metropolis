<x-dashboard-layout>
    <div class="flex items-center justify-center grow max-h-full">
        <x-card class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <x-slot name="title">
                Simulation view
            </x-slot>
            <p class="text-sm text-bg-foreground">Welkom op het simulatie overzicht</p>

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
