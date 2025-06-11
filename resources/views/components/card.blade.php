<div {{ $attributes->class(['rounded-md border border-border bg-bg text-bg-foreground flex-col']) }}>
    <div class="flex gap-2 p-6 align items-center justify-between">
        @if($title)
            <h1 {{ $title->attributes->class(['font-bold text-xl leading-none tracking-tight']) }}>
                {{ $title }}
            </h1>
        @endif
        @isset($buttons)
            <div class="flex gap-2">
                {{ $buttons }}
            </div>
        @endif
    </div>
    <div class="p-6 pt-0 flex-grow">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="p-6 pt-0">
            {{ $footer }}
        </div>
    @endif
</div>
