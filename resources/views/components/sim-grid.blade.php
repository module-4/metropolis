@props([
    'components' => []
])

<div class="
    overflow-y-auto
    overflow-hidden
    gap-1
    sim-grid
    grid
    grid-cols-4
    grid-rows-3
    ">
    @for($y = 0; $y < 3; $y++)
        @for($x = 0; $x < 4; $x++)
            @php
                $gridComponent = $components->first(function ($c) use ($x, $y) {
                    return $c->pivot->x === $x && $c->pivot->y === $y;
                });
            @endphp
            <x-sim-grid-tile :x="$x" :y="$y">
                @if($gridComponent)
                    <x-sim-component :id="$gridComponent->id">
                        <img src="{{$gridComponent->image_name}}" alt="{{$gridComponent->name}}" class="pointer-events-none max-w-[64px] rounded-sm"/>
                        <p>{{ $gridComponent->name }}</p>
                    </x-sim-component>
                @endif
                <div class="tile-info">
                    <ul></ul>
                </div>
            </x-sim-grid-tile>
        @endfor
    @endfor
</div>
