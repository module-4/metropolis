<a {{ $attributes->class(['flex items-center p-2 text-bg-foreground rounded-lg hover:bg-bg-200 group', 'bg-bg-200 text-primary' => $active])->merge(['href' => $href]) }}>
    @if($icon)
        <div {{ $icon->attributes->class(['w-5 h-5 text-bg-300 transition duration-75 group-hover:text-primary mr-3', 'text-primary' => $active]) }}>
            {{ $icon }}
        </div>
    @endif
    <span class="">
        {{ $slot }}
    </span>
</a>
