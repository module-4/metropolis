@props([
    'components' => []
])

<div class="
    overflow-y-auto
    overflow-hidden
    bg-blue-950
    border
    border-blue-950
    rounded-md
    gap-0.25

    col-span-1
    min-md:col-span-2
    min-lg:col-span-3
    min-lg:row-span-2
    min-lg:max-h-[400px]
    sim-grid
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
                    <x-sim-component :id="$gridComponent->id" :isApproved="$gridComponent->pivot->approved" :inLibrary="false">
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
