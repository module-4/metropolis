@props([
    'category' => null
])

<details class="bg-white rounded-md border border-border sim-component-group-accordion">
    <summary class="px-4 py-4 cursor-pointer select-none">
        {{ $category?->name ?? 'Uncategorized' }}
    </summary>
    <div class="sim-component-group p-3 pt-0 flex flex-col gap-2">
        {{ $slot }}
    </div>
</details>
