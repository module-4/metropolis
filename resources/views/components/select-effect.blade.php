<select name="effects[__index__][id]"
        class="flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm data-[placeholder]:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 ring-offset-2 ring-primary focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1"
        required>
    @foreach ($effects as $effect)
        <option value="{{ $effect->id }}">{{ $effect->name }}</option>
    @endforeach
</select>
