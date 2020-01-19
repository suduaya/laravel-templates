<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // users
      User::truncate();
      $admin = User::create([
        "name" => "admin",
        "email" => "admin@admin.com",
        "password" => bcrypt("admin")
      ]);

      $author = User::create([
        "name" => "author",
        "email" => "author@author.com",
        "password" => bcrypt("author")
      ]);

      $user = User::create([
        "name" => "user",
        "email" => "user@user.com",
        "password" => bcrypt("user")
      ]);

      // roles
      $adminRole = Role::where(["name" => "admin"])->first();
      $authorRole = Role::where(["name" => "author"])->first();
      $userRole = Role::where(["name" => "user"])->first();

      $admin->roles()->attach($adminRole);
      $author->roles()->attach($authorRole);
      $user->roles()->attach($userRole);
    }
}
