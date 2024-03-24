<?php

use function Livewire\Volt\{state,updated,updating};
use Illuminate\Support\Facades\Auth;
state([
    'email',
    'password'
]);
// updated(['email'=>function(){
//     //dd('updated');
// }]);
// updating(['email'=>function(){
//     dd('updating');
// }]);


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

        <x-input label="EMAIL" icon="o-envelope" wire:model.live="email" />


        <x-input label="Password" type="password" icon="o-eye" wire:model="password" hint="It submits an unmasked value" />



        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
