<div {{ $attributes->class(['rounded-xl border border-border bg-bg text-bg-foreground shadow flex-col']) }}>

    @if($title)
        <h1 {{ $title->attributes->class(['font-bold text-xl leading-none tracking-tight p-6']) }}>
            {{ $title }}
        </h1>
    @endif
    <div class="p-6 pt-0 flex-grow">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="p-6 pt-0">
            {{ $footer }}
        </div>
    @endif
</div>
