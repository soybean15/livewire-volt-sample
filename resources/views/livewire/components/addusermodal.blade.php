<?php

use function Livewire\Volt\{state,uses};
use \App\Models\Student;
//
use Mary\Traits\Toast;

uses([Toast::class]);
state([
    'myModal1',
    'form'=>[
        'firstname'=>'',
        'lastname'=>'',
        'middlename'=>'',
        'gender'=>'',
        'birthdate'=>'',
        'address'=>'',
],
'genderOption'=>[
    [
        'id'=>'male',
        'name'=>'Male'
],
[
        'id'=>'female',
        'name'=>'Female'
    ]
]
]);

$save = function(){


    $this->validate([
        'form.firstname'=>'required',
        'form.lastname'=>'required',
        'form.middlename'=>'',
        'form.gender'=>'required',
        'form.birthdate'=>'required',
        'form.address'=>'required',
]);

Student::create($this->form);

$this->myModal1=false;
$this->success('This is toast',
    position: 'bottom-end'

);

$this->dispatch('student-created');



}

?>

<div>

    <x-button class="btn-primary" @click="$wire.myModal1 = true">
        Add User
    </x-button>

    <x-modal wire:model="myModal1" class="backdrop-blur">
        <div class="mb-5">

            <form wire:submit.prevent='save()' class="space-y-3">



                <x-input label="First Name" wire:model="form.firstname" />
                <x-input label="Last Name" wire:model="form.lastname" />
                <x-input label="Middle Name" wire:model="form.middlename" />
                <x-radio label="Select one" :options="$genderOption" wire:model="form.gender" />
                <x-datetime label="Birth date" wire:model="form.birthdate" icon="o-calendar" />


                <x-textarea label="Address" wire:model="form.address" placeholder="Your address..."
                    hint="Max 1000 chars" rows="3" inline />


                <x-button label="Submit" type='submit' />


                <x-button label="Cancel" @click="$wire.myModal1 = false" />

            </form>


        </div>

    </x-modal>


</div>
