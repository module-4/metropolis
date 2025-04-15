<label {{ $attributes->merge(['class' => 'text-sm font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70']) }}>
    {{ $slot }}@if($required)
        <span class="text-danger ml-0.5">*</span>
    @endif
</label>
