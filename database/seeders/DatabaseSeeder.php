<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'employee',
            'customer'
        ];
        
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $user = \App\Models\User::create([
                'name' => "Arfian Dimas Andi Permana",
                'email' => "arfiandimas@gmail.com",
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::where('name', 'super-admin')->first();
        $role->users()->attach($user);
        Artisan::call('passport:install');
        $user->createToken('Personal Access Token',['admin']);

        $permissions = [
            'product-index',
            'product-store',
            'product-show',
            'product-update',
            'product-destroy'
        ];
 
 
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
