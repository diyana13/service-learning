<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'lecturer']);
        Permission::create(['name' => 'student']);
        Permission::create(['name' => 'assessor']);

        Role::create(['name' => 'lecturer'])->givePermissionTo('lecturer');
        Role::create(['name' => 'student'])->givePermissionTo('student');
        Role::create(['name' => 'assessor'])->givePermissionTo('assessor');

        $user = User::create([
            'name' => 'Lecturer',
            'email' => 'lecturer@local.com',	
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('lecturer');

        $user = User::create([
            'name' => 'Student',
            'email' => 'student@local.com',	
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('student');

        $user = User::create([
            'name' => 'Assessor',
            'email' => 'assessor@local.com',	
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('assessor');
    }
}
