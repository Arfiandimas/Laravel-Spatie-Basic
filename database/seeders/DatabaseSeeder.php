<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'super-admin']);

        $user = \App\Models\User::create([
                'name' => "Arfian Dimas Andi Permana",
                'email' => "arfiandimas@gmail.com",
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);

        $role->users()->attach($user);
    }
}
