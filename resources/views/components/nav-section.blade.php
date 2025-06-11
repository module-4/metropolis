<div class="flex flex-col gap-2">
    @if($title)
        <h1 class="font-semibold pl-1 py-0.5 leading-none tracking-tight">
            {{ $title }}
        </h1>
    @endif
    <ul class="space-y-2 font-medium">
        {{ $slot }}
    </ul>
</div>
