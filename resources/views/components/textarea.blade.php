<textarea {{ $attributes->class(['flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 ring-offset-2 ring-primary focus-visible:ring-ring disabled:opacity-50 md:text-sm'])->merge(['rows' => 4])}}>{{ $slot }}
</textarea>
