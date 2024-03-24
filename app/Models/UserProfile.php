<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
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

  //  protected $guarded=[];



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
