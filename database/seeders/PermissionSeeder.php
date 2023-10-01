<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
     public function run()
    {
      $user_list = Permission::create(['name'=>'user.list']);
      $user_view = Permission::create(['name'=>'user.view']);
      $user_create = Permission::create(['name'=>'user.create']);
      $user_update = Permission::create(['name'=>'user.update']);
      $user_delete = Permission::create(['name'=>'user.delete']);


      $admin_role = Role::create(['name'=>'admin']);
      $admin_role->givePermissionTo([
        $user_list,
        $user_create,
        $user_delete,
        $user_update,
      ]);

      $admin = User::create([

        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'),
      ]);


      $admin->assignRole('admin_role');
      $admin->givePermissionTo([

        $user_list,
        $user_create,
        $user_delete,
        $user_update,
      ]);



      $user = User::create([

        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => bcrypt('password'),
      ]);


      $user_role = Role::create(['name'=>'user']);
      $user->assignRole('user_role');
      $user->givePermissionTo([
        $user_list,
      ]);
}

}

