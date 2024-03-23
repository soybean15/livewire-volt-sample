<?php

use function Livewire\Volt\{state};

state([
    'count' => 0,
    'name'=>'Marlon Padilla',
    ]
);




$increment = fn () => $this->count++;

?>

<div>

    Welcome Guest
    {{-- <x-header title="Personal address" subtitle="{{ $name }}" separator />
    <h1>{{ $count }}</h1>
    <h1>{{ $name }} </h1>
    <button wire:click="increment">+</button> --}}
</div>
