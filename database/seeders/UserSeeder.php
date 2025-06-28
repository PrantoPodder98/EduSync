<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $admin = Role::create(['name' => 'super-admin']);

        //creating a super admin user
        $AdminUser = new User;
        $AdminUser->name = 'Super Admin';
        $AdminUser->email = 'admin@gmail.com';
        $AdminUser->password =  Hash::make('12345678');
        $AdminUser->save();

        $AdminUser->assignRole($admin);


        $user = new User;
        $user->name = 'User';
        $user->email = 'user@email.com';
        $user->password = Hash::make('12345678');
        $user->save();
    }
}
