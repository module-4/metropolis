<x-dashboard-layout>

    <x-card class="w-full h-full mx-5 my-3">
        <x-slot name="title">
            {{__("Categories")}}
        </x-slot>
        <div class="max-w-screen-md">
            <section>
                <h2 class="font-semibold mb-2">{{__("New category")}}:</h2>
                <form action="{{route('category.store')}}" method="POST" class="flex gap-4 items-end mb-4">
                    @csrf
                    <div class="w-full">
                        <x-label for="name" required>{{__("Category name")}}</x-label>
                        <x-input name="name" required :value="old('name')"/>
                        <x-input-error :messages="$errors->get('name')"/>
                    </div>
                    <x-button type="submit" class="hover:cursor-pointer">New</x-button>
                </form>
            </section>
            <section>
                <h2 class="font-semibold mb-2">{{__("Existing categories")}}:</h2>
                <x-table>
                    <x-slot:thead>
                        <x-table-head>{{__("Name")}}</x-table-head>
                        <x-table-head>{{__("Actions")}}</x-table-head>
                    </x-slot:thead>
                    @forelse($categories as  $category)
                        <x-table-row>
                            <x-table-data>
                                <form action="{{route('category.update',['category'=>$category])}}" method="POST"
                                      class="flex gap-4 items-end mb-4"
                                      id="updateCategoryForm">
                                    @csrf
                                    @method("PUT")
                                    @php
                                        $inputName =$category->id."name";
                                    @endphp
                                    <div class="w-full">
                                        <x-label :for="$inputName" required>{{ __("Category name") }}</x-label>
                                        <x-input
                                            :name="$inputName"
                                            :id="$inputName"
                                            required
                                            :value="old($inputName, $category->name ?? '')"
                                        />
                                        <x-input-error :messages="$errors->get($inputName)"/>
                                    </div>
                                </form>
                            </x-table-data>
                            <x-table-data class="flex gap-4">
                                <x-button form="updateCategoryForm" type="submit" class="hover:cursor-pointer">
                                    Update
                                </x-button>
                                <form method="POST" action="{{route("category.destroy",["category"=>$category])}}"
                                      class="flex items-center gap-2">
                                    @csrf
                                    @method("DELETE")
                                    <x-button variant="danger" type="submit" class="hover:cursor-pointer">
                                        Delete
                                    </x-button>
                                </form>
                            </x-table-data>
                        </x-table-row>
                    @empty
                        <x-table-row>
                            <x-table-data colspan="7" class="text-center">
                                {{__("No categories found")}}
                            </x-table-data>
                        </x-table-row>
                    @endforelse
                </x-table>
            </section>
        </div>
    </x-card>

</x-dashboard-layout>
