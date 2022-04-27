<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => 'system admin']);
        $role2 = Role::create(['name' => 'system editor']);
        $role3 = Role::create(['name' => 'system user']);
        $role4 = Role::create(['name' => 'company admin']);
        $role5 = Role::create(['name' => 'company user']);


        $user = \App\Models\User::create([
            'company'  => 'Riffpedia', 
            'first_name'  => 'system',
            'last_name'  => 'admin',
            'address'  => '8 Quincy Parkway', 
            'phone_number'  => '+46 (990) 985-2798',
            'username'  => 'administrator', 
            'email'  => 'administrator@example.com', 
            'password'  => Hash::make('password'),
            'role'  => 'system admin',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::create([
            'company'  => 'Riffpedia', 
            'first_name'  => 'system',
            'last_name'  => 'editor',
            'address'  => '8 Quincy Parkway', 
            'phone_number'  => '+46 (990) 985-2798',
            'username'  => 'editor', 
            'email'  => 'editor@example.com', 
            'password'  => Hash::make('password'),
            'role'  => 'system editor',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::create([
            'company'  => 'Riffpedia', 
            'first_name'  => 'system',
            'last_name'  => 'user',
            'address'  => '8 Quincy Parkway', 
            'phone_number'  => '+46 (990) 985-2798',
            'username'  => 'user', 
            'email'  => 'user@example.com', 
            'password'  => Hash::make('password'),
            'role'  => 'system user',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::create([
            'company'  => 'Riffpedia', 
            'first_name'  => 'company',
            'last_name'  => 'admin',
            'address'  => '8 Quincy Parkway', 
            'phone_number'  => '+46 (990) 985-2798',
            'username'  => 'compadmin', 
            'email'  => 'compadmin@example.com', 
            'password'  => Hash::make('password'),
            'role'  => 'company admin',
        ]);
        $user->assignRole($role4);

        $user = \App\Models\User::create([
            'company'  => 'Riffpedia', 
            'first_name'  => 'company',
            'last_name'  => 'user',
            'address'  => '8 Quincy Parkway', 
            'phone_number'  => '+46 (990) 985-2798',
            'username'  => 'compuser', 
            'email'  => 'compuser@example.com', 
            'password'  => Hash::make('password'),
            'role'  => 'company user',
        ]);
        $user->assignRole($role5);


        $company = \App\Models\Company::create([
            'company'  => 'Quantum', 
            'first_name'  => 'company',
            'last_name'  => 'admin',
            'address'  => '18 Quincy Parkway', 
            'reg_number'  => '1397702389', 
            'phone_number'  => '+46 (990) 985-2798',
            'username'  => 'compadmin', 
            'email'  => 'compadmin@example.com', 
            'password'  => 'compadmin',
            'role'  => 'company admin',
        ]);
        $company->assignRole($role4);

        $company = \App\Models\Company::create([
            'company'  => 'Raspberry', 
            'first_name'  => 'company',
            'last_name'  => 'user',
            'address'  => '19 Quincy Parkway', 
            'reg_number'  => '9832077931', 
            'phone_number'  => '+46 (990) 985-8972',
            'username'  => 'compuser2', 
            'email'  => 'compuse2r@example.com', 
            'password'  => 'compuser2',
            'role'  => 'company user',
        ]);
        $company->assignRole($role5);
    }
}
