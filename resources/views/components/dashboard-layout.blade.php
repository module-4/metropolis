@extends('layouts.base')
<div class="min-h-screen bg-bg-200 flex flex-col">
    <header class="bg-bg p-4 border-b gap-2 text-xl font-bold items-center border-border flex">
        <a class="flex items-center gap-2 rounded-md mr-auto focus-visible:outline-none focus-visible:ring-2 ring-offset-2 ring-primary focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" href="{{ route('dashboard') }}"
           aria-label="Navigate to dashboard page">
            <span aria-hidden="true" class="bg-primary text-primary-foreground p-2 rounded-xl">
                <x-tabler-building-skyscraper aria-hidden="true" class="w-6 h-6"/>
            </span>
            Metropolis
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <x-button variant="ghost" type="submit" class="flex">
                Log out
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"/>
                    <path d="M9 12h12l-3 -3"/>
                    <path d="M18 15l3 -3"/>
                </svg>
            </x-button>
        </form>
    </header>
    <main class="grow flex">
        <nav class="flex">
            <div class="bg-bg w-64 border-r border-border">
                <div class="py-4 overflow-y-auto px-2">
                    <ul class="space-y-2 font-medium">
                        @include('components.nav')
                    </ul>
                </div>
            </div>
        </nav>
        {{ $slot }}
    </main>
</div>
