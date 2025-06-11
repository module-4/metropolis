<a {{ $attributes->class(['flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 hover:text-primary group focus-visible:outline-none focus-visible:ring-2 ring-offset-2 ring-primary focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50', 'bg-gray-100 text-primary' => $active])->merge(['href' => $href]) }}>
    @if($icon)
        <div {{ $icon->attributes->class(['w-5 h-5 mr-3']) }}>
            {{ $icon }}
        </div>
    @endif
    <span>
        {{ $slot }}
    </span>
</a>
