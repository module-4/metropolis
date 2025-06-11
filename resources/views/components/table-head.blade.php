<th class="
    bg-primary
    text-primary-foreground
    px-5
    py-3
    text-left
    text-sm
    font-bold
    cursor-default
    select-none
">
    <div {{ $attributes->class(["flex items-center gap-1"])->merge() }}>
        {{ $slot }}
    </div>
</th>
