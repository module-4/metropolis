<x-dashboard-layout>
    <div class="flex flex-wrap content-start">
         @foreach($data as $component)
           <x-component-effect-card
             :component="$component"
             >

           </x-component-effect-card>

         @endforeach
    </div>
</x-dashboard-layout>
