<table {{ $attributes->class(["w-full border-separate border-spacing-0 border border-border rounded-md overflow-hidden"])->merge() }}>
    <thead>
        <tr>
            {{ $thead }}
        </tr>
    </thead>
    <tbody class="divide-y divide-border">
        {{ $slot }}
    </tbody>
</table>
