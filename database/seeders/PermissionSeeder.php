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
        // Define permissions related to books and orders
        $createBook = Permission::create(['name' => 'create book']);
        $updateBook = Permission::create(['name' => 'update book']);
        $deleteBook = Permission::create(['name' => 'delete book']);
        $viewOrder = Permission::create(['name' => 'view order']);
        $createOrder = Permission::create(['name' => 'create order']);
        $updateOrder = Permission::create(['name' => 'update order']);
        $deleteOrder = Permission::create(['name' => 'delete order']);

        // Define permissions for user-related routes
        $registerUser = Permission::create(['name' => 'register user']);
        $loginUser = Permission::create(['name' => 'login user']);
        $logoutUser = Permission::create(['name' => 'logout user']);
        $viewUserProfile = Permission::create(['name' => 'view user profile']);

        // Define permissions for newsletter and wishlist routes
        $subscribeNewsletter = Permission::create(['name' => 'subscribe newsletter']);
        $unsubscribeNewsletter = Permission::create(['name' => 'unsubscribe newsletter']);
        $viewWishlist = Permission::create(['name' => 'view wishlist']);
        $addToWishlist = Permission::create(['name' => 'add to wishlist']);
        $deleteFromWishlist = Permission::create(['name' => 'delete from wishlist']);

        // Define roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions to roles
        $adminRole->givePermissionTo([
            $createBook,
            $updateBook,
            $deleteBook,
            $viewOrder,
            $createOrder,
            $updateOrder,
            $deleteOrder,
            $registerUser,
            $loginUser,
            $logoutUser,
          ]);
          
          $userRole->givePermissionTo([
            $registerUser,
            $loginUser,
            $logoutUser,
            $viewUserProfile,
            $subscribeNewsletter,
            $unsubscribeNewsletter,
            $viewWishlist,
            $addToWishlist,
            $deleteFromWishlist,
            $subscribeNewsletter,
            $viewWishlist,
        ]);
     
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole($adminRole);
      
        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
        ]);
        $user->assignRole($userRole);
    }
}

