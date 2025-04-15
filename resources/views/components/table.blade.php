<div class="rounded-md border border-border bg-bg">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-primary/20 text-foreground">
            <tr>
                {{ $thead }}
            </tr>
            </thead>
            <tbody class="divide-y divide-border">
            {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
