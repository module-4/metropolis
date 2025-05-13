<li>
    <x-nav-section>
        <x-slot:title>
            General
        </x-slot:title>
        <li>
            <x-nav-item href="{{ route('dashboard') }}"
                        active="{{ request()->routeIs('dashboard') }}">
                <x-slot:icon>
                    <x-tabler-dashboard/>
                </x-slot:icon>
                Dashboard
            </x-nav-item>
            <x-nav-item href="{{ route('simulation') }}"
                        active="{{ request()->routeIs('simulation') }}">
                <x-slot:icon>
                    <x-tabler-map-route/>
                </x-slot:icon>
                Simulation
            </x-nav-item>
            <x-nav-item href="{{ route('component-effect-management') }}"
                        active="{{ request()->routeIs('component-effect-management') }}">
                <x-slot:icon>
                    <x-tabler-map-route/>
                </x-slot:icon>
                Component Effect Management
            </x-nav-item>
        </li>
    </x-nav-section>
</li>
