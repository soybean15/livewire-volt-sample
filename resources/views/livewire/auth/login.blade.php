<?php

use function Livewire\Volt\{state};
use Illuminate\Support\Facades\Auth;
state(['email', 'password']);

$login = function () {
    $this->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (Auth::attempt(['email' => $this->email, 'password' => $this->password], false)) {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect(route('admin'));
        }
        if ($user->hasRole('teacher')) {
            return redirect(route('teacher'));
        }
        if ($user->hasRole('student')) {
            return redirect(route('student'));
        }
    }

    return redirect('/');
};

?>

<div>



    <x-form wire:submit.prevent="login">

        <x-input label="EMAIL" icon="o-envelope" wire:model="email" />

        @error('email')
            {{ $message }}
        @enderror

        <x-input label="Password" type="password" icon="o-eye" wire:model="password" hint="It submits an unmasked value" />


        @error('password')
            {{ $message }}
        @enderror
        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
