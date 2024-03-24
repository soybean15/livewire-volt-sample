<?php

use function Livewire\Volt\{state,mount,usesPagination,updated,computed,on,uses,with};
use \App\Models\Student;


//
use Mary\Traits\Toast;

uses([Toast::class]);


usesPagination();


state([
    'headers',
    'searchText'
]);

//old
// $students = computed(function () {
//     return  Student::search($this->searchText)->paginate(10);
// });

// updated(['searchText' => function (){

//     $this->students = Student::search($this->searchText)->paginate(10);
// }]);

//new
with(fn () => ['students' =>  Student::search($this->searchText)->paginate(10)]);




on(['student-created' => function () {

    $this->dispatch('$refresh');

},
]);

mount(function(){

    $this->headers = [
        ['key' => 'fullname', 'label' => 'Full Name'],
        ['key' => 'gender', 'label' => 'Gender',],
        ['key' => 'birthdate', 'label' => 'Birth Date', ],
        ['key' => 'address', 'label' => 'Address', ],
        ['key' => 'action', 'label' => 'Action', ],
    ];


 //   dd($this->users);

});


$delete = function($id){


    $student = Student::find($id);

    if($student){
        $student->delete();

        $this->success('Student Deleted',
    position: 'bottom-end',

);

    }else{
        $this->error('Student not found',
            position: 'bottom-end'

        );
    }

};


?>

<div>

    <div class="flex items-center justify-between">

        <div class="text-xl font-bold">Students </div>

        <x-input label="Search" wire:model.live="searchText" icon-right="s-magnifying-glass" />

    </div>

    <livewire:components.addusermodal>

        <x-table :headers="$headers" :rows="$students" with-pagination>

            @scope('cell_fullname', $student)

            {{ $student->full_name }}
            @endscope
            @scope('cell_gender', $student)
            {{ $student->gender }}

            @endscope
            @scope('cell_birthdate', $student)
            <x-badge :value=" $student->birthdate" class="badge-success" />
            @endscope
            @scope('cell_address', $student)

            {{ $student->address }}
            @endscope
            @scope('cell_action', $student)

            <div class="flex space-x-2">

                <x-button x-on:click="$dispatch('edit-student',{id:{{ $student->id }}})" icon="o-pencil-square"
                    class="btn-circle" />

                <x-button icon="o-trash" class="btn-circle btn-error"
                    wire:confirm='Are sure you want to delete this student?' wire:click='delete({{ $student->id }})' />
            </div>


            @endscope
            {{-- @scope('cell_fullname', $user)

            {{ $user->profile ? $user->profile->full_name :'N/A' }}
            @endscope
            @scope('cell_gender', $user)
            {{ $user->profile ? $user->profile->gender:'N/A' }}

            @endscope
            @scope('cell_birthdate', $user)
            <x-badge :value=" $user->profile ? $user->profile->birthdate:'N/A'" class="badge-success" />
            @endscope
            @scope('cell_address', $user)

            {{ $user->profile ? $user->profile->address:'N/A' }}
            @endscope --}}
        </x-table>

        <livewire:components.editusermodal />
</div>
