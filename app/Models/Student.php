<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student extends Model
{
    use HasFactory;

    protected $fillable =[
        'firstname',
        'lastname',
        'gender',
        'middlename',
        'birthdate',
        'address'
    ];


    public function scopeSearch(Builder $builder , $searchText){

        return
            $builder->where('firstname','like' ,$searchText.'%')
            ->orWhere('lastname','like' ,$searchText.'%')
            ->orWhere('middlename','like' ,$searchText.'%')
            ->orWhere('gender','like' ,$searchText.'%')
            ;


    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function ()  {


                $middlename ='';
                if(!($this->middlename ==null || trim($this->middlename)=='')){
                    $middlename = $this->middlename;
                }

                return $this->firstname .' ' .$this->lastname . ' '. substr($middlename,0,1);
            },
        );
    }
}
