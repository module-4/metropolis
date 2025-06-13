<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
<div class="flex justify-center flex-col p-6">
    <h1 class="font-bold text-2xl py-6">Simulation Report {{ $dateOfExport }}</h1>
    <x-sim-grid :components="$simulationComponents" />
    <h2 class="font-bold text-2xl py-6">Total Grid Effects</h2>
    <x-table>
        <x-slot:thead>
            <x-table-head>Effect name</x-table-head>
            <x-table-head>Value</x-table-head>
        </x-slot:thead>
        @forelse($totalEffects as $key => $value)
            <x-table-row>
                <x-table-data>{{ $key }}</x-table-data>
                <x-table-data>{{ $value }}</x-table-data>
            </x-table-row>
        @empty
            <x-table-row>
                <x-table-data><p>No effects found.</p></x-table-data>
                <x-table-data></x-table-data>
            </x-table-row>
        @endforelse
    </x-table>
    @pageBreak
    <h2 class="font-bold text-2xl py-6">Used Components and Effects</h2>
    <x-table>
        <x-slot:thead>
            <x-table-head>Component name</x-table-head>
            <x-table-head>Position (X, Y)</x-table-head>
            <x-table-head>Category</x-table-head>
            <x-table-head>Effects</x-table-head>
        </x-slot:thead>
        @forelse($simulationComponents as $comp)
            <x-table-row>
                <x-table-data>{{ $comp->name }}</x-table-data>
                <x-table-data>
                    <p>X: {{ $comp->pivot->x }}</p>
                    <p>Y: {{ $comp->pivot->y }}</p>
                </x-table-data>
                <x-table-data>{{ $comp->category->name }}</x-table-data>
                <x-table-data>
                    @foreach($comp->effects as $effect)
                        <p><strong>{{ $effect->name }}:</strong> {{$effect->pivot->value}}</p>
                    @endforeach
                </x-table-data>
            </x-table-row>
        @empty
            <x-table-row>
                <x-table-data><p>No used components or effects found.</p></x-table-data>
                <x-table-data></x-table-data>
                <x-table-data></x-table-data>
                <x-table-data></x-table-data>
            </x-table-row>
        @endforelse
    </x-table>
</div>
</body>
</html>
