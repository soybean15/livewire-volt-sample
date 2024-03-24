<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => ' Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
        ]);

        $user3 = User::create([
            'name' => ' Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
        ]);
         $admin = Role::create([
            'name' => 'admin',
        ]);


        $teacher = Role::create([
            'name' => 'teacher',
        ]);
        $student = Role::create([
            'name' => 'student',


        ]);

        $user->roles()->attach( $admin);
        $user2->roles()->attach( $teacher);
        $user3->roles()->attach( $student);



        User::factory(5)->create();
    }
}
