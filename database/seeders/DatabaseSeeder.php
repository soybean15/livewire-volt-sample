<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => ' Teacher',
            'email' => 'teacher@example.com',
        ]);

        $user3 = User::factory()->create([
            'name' => ' Student',
            'email' => 'student@example.com',
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
    }
}
