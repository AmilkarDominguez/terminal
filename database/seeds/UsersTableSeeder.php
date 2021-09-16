<?php

use App\Role;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ////////////////////////////////////////    
        // ROLES//

        $role_super_admin = new Role();
        $role_super_admin->name = 'super_admin';
        $role_super_admin->description = 'Administrator';
        $role_super_admin->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Administrator';
        $role_admin->save();

        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'User';
        $role_user->save();


        //CREA EL USUARIOS

        $super_admin = App\User::create([
            'name' => 'root',
            'last_name' => 'root',
            'email' => 'root@root.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('password2021'),
            'remember_token' => str_random(10)
        ]);

        $admin = App\User::create([
            'name' => 'admin',
            'last_name' => 'adminitrador general',
            'email' => 'admin@admin.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10)
        ]);

        //ASIGNACION DE ROLES
        $super_admin->roles()->attach($role_super_admin);
        $admin->roles()->attach($role_admin);
    }
}
