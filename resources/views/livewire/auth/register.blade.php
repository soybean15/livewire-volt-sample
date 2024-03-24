<?php

use function Livewire\Volt\{state,uses};
use \App\Models\User;
use Mary\Traits\Toast;

use Illuminate\Support\Facades\Validator;
uses([Toast::class]);
state([
    'form'=>[
        'name'=>'',
        'email'=>'',
        'password'=>'',
        'password_confirmation'=>''
    ]
]);
//users
//name
//email
//password



$register = function(){

//updating()


//     $this->validate(
//     [
//         'form.name'=>'required|string',
//         'form.email'=>'required|email|unique:users,email',
//         'form.password'=>'required|min:6|confirmed',
//         'form.password_confirmation'=>'required'
// ],[
//     'form.name.required'=> 'Name is Required',
//     'form.name.string'=> 'Name should be string',
//     'form.email.required'=>  'Email is Required',
//     'form.email.required'=> 'Invalid Email',
//     'form.email.required'=> 'Email already taken',

//     'form.password.required'=> 'Password is Required',
//     'form.password.min'=> 'Password must be at least 6 character',
//     'form.password.confirmed'=> 'Password did not match',

// ]);

$validator = Validator::make($this->form,
    [
        'form.name'=>'required|string',
        'form.email'=>'required|email|unique:users,email',
        'form.password'=>'required|min:6|confirmed',
        'form.password_confirmation'=>'required'
],[
    'form.name.required'=> 'Name is Required',
    'form.name.string'=> 'Name should be string',
    'form.email.required'=>  'Email is Required',
    'form.email.required'=> 'Invalid Email',
    'form.email.required'=> 'Email already taken',

    'form.password.required'=> 'Password is Required',
    'form.password.min'=> 'Password must be at least 6 character',
    'form.password.confirmed'=> 'Password did not match',
]
)->validate();

    User::create($this->form);

$this->success('This is toast',
    position: 'bottom-end',
    redirectTo: route('login')
);

// if(!$validator->fails()){

//     User::create($this->form);

// $this->success('This is toast',
//     position: 'bottom-end',
//     redirectTo: route('login')
// );
// }else{

// $this->error('This is toast',
//     position: 'bottom-end',
// );




}


?>

<div>
    <x-form wire:submit.prevent="register">

        <x-input label="Name" icon="o-user" wire:model="form.name" />


        <x-input label="EMAIL" icon="o-envelope" wire:model="form.email" />


        <x-input label="Password" type="password" icon="o-eye" wire:model="form.password"
            hint="It submits an unmasked value" />




        <x-input label="Password" type="password" icon="o-eye" wire:model="form.password_confirmation"
            hint="It submits an unmasked value" />


        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
