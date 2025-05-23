@props([
    'icon'
])

<dialog {{ $attributes->class(['fixed top-[50%] left-[50%] -translate-[50%] border border-border rounded-md backdrop-blur-2xl drop-shadow-2xl max-w-[600px]']) }}>
    @if (isset($heading) && $heading->hasActualContent())
        <header class="flex items-center gap-6 p-5 border-b border-border">
            @if($icon)
            <div class="ml-2">
                {{ $icon }}
            </div>
            @endif
            <div class="flex flex-col pe-2">
                <h1 class="text-2xl font-bold">{{ $heading }}</h1>
                @if (isset($description) && $description->hasActualContent())
                    <p class="text-md italic text-gray-500">{{ $description }}</p>
                @endif
            </div>
        </header>
    @endif
    <section class="px-5 py-7 pe-8 max-h-72 overflow-y-auto">
        {{ $slot }}
    </section>
    @if (isset($footer) && $footer->hasActualContent())
        <footer class="flex p-5 justify-end items-center gap-2 border-t border-border">
            {{ $footer }}
        </footer>
    @endif
</dialog>
