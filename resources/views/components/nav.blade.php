<li>
    <x-nav-section>
        <x-slot:title>
            General
        </x-slot:title>
        <li class="flex flex-col gap-1">
            <x-nav-item href="{{ route('dashboard') }}"
                        active="{{ request()->routeIs('dashboard') }}"
                        aria-label="Navigate to dashboard page">
                <x-slot:icon>
                    <x-tabler-dashboard aria-hidden="true"/>
                </x-slot:icon>
                Dashboard
            </x-nav-item>
            <x-nav-item href="{{ route('simulation') }}"
                        active="{{ request()->routeIs('simulation') }}"
                        aria-label="Navigate to simulation page">
                <x-slot:icon>
                    <x-tabler-map-route aria-hidden="true"/>
                </x-slot:icon>
                Simulation
            </x-nav-item>
            <x-nav-item href="{{ route('component-effect-management') }}"
                        active="{{ request()->routeIs('component-effect-management') }}"
                        aria-label="Navigate to component effect management page">
                <x-slot:icon>
                    <x-tabler-waves-electricity aria-hidden="true"/>
                </x-slot:icon>
                Component Effect Management
            </x-nav-item>
            <x-nav-item href="{{ route('component-manager') }}"
                        active="{{ request()->routeIs('component-manager') }}"
                        aria-label="Navigate to component manager page">
                <x-slot:icon>
                    <x-tabler-puzzle aria-hidden="true"/>
                </x-slot:icon>
                Component Manager
            </x-nav-item>
            <x-nav-item href="{{ route('events.index') }}"
                        active="{{ request()->routeIs('events.index') }}">
                <x-slot:icon>
                    <x-tabler-building-circus/>
                </x-slot:icon>
                Events Manager
            </x-nav-item>
            <x-nav-item href="{{ route('blocklist.index') }}"
                        active="{{ request()->routeIs('blocklist.index') }}"
                        aria-label="Navigate to placement restrictions page">
                <x-slot:icon>
                    <x-tabler-ban aria-hidden="true"/>
                </x-slot:icon>
                Placement restrictions
            </x-nav-item>
        </li>
    </x-nav-section>
</li>
