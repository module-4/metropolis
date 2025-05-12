<tr class="border-b">
    <td class="p-3 w-1/2">{{ $effect->name }}</td>
    <td class="p-3 w-1/4">
        <form id="form-{{ $effect->name }}" method="POST" action="{{ route('component-effect-management-update', ['componentId' => $component->id, 'effectId' => $effect->id]) }}">
            @csrf
            @method('PATCH')
            <input value="{{ $effect->pivot->value }}" name="effect-value" type="number" class="border rounded px-3 py-2 w-full text-center"/>
        </form>
    </td>
    <td class="p-3 w-1/4">
        <button form="form-{{ $effect->name }}" class="bg-primary hover:bg-primary/90 text-primary-foreground px-4 py-2 rounded">
            Update
        </button>
    </td>
</tr>
