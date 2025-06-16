
<div
    {{$attributes}}
    {{$attributes->class("flex flex-col gap-2 items-center justify-center border border-dashed border-danger text-danger text-sm text-center rounded-md px-2 py-8")}}
>
    <x-tabler-trash class="h-7 w-7"/>
    {{ $slot }}
</div>
