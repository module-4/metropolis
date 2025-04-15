@extends('layouts.card')

@section('card')
    <form method="post" action="{{ route('login') }}">
        @csrf
        <x-card>
            <x-slot name="title">Login</x-slot>
            <div class="space-y-2">
                <x-label for="email" required>Email</x-label>
                <x-input name="email" type="email" placeholder="Email" required/>
                <x-input-error :messages="$errors->get('email')"/>
                <x-label for="password" required>Password</x-label>
                <x-input name="password" type="password" placeholder="Password" required/>
                <x-input-error :messages="$errors->get('password')"/>
            </div>
            <x-slot:footer>
                <x-button type="submit">Login</x-button>
            </x-slot:footer>
        </x-card>
    </form>
@endsection
