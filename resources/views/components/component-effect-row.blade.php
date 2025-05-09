<tr class="border-b">
    <td class="p-3 w-1/2">{{ $effect->name }}</td>
    <td class="p-3 w-1/4">
        <input value="{{ $effect->pivot->value }}" type="number" class="border rounded px-3 py-2 w-full text-center"/>
    </td>
    <td class="p-3 w-1/4">
        <button class="bg-primary hover:bg-primary/90 text-primary-foreground px-4 py-2 rounded">
            Update
        </button>
    </td>
</tr>
