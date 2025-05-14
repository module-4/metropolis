<x-dashboard-layout>
    <div class="flex flex-wrap content-start">
         @foreach($data as $simComponent)
           <x-component-effect-card
             :simComponent="$simComponent"
             >

           </x-component-effect-card>

         @endforeach
    </div>
</x-dashboard-layout>
