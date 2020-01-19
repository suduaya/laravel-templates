<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Post;
use App\Comment;

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

      // Posts and relationship with users
      Post::truncate();
      $adminPost = Post::create([
        "title" => "admin title post",
        "text" => "text of admin post",
        "user_id" => $admin->id
      ]);

      $authorPost = Post::create([
        "title" => "author title post",
        "text" => "text of author post",
        "user_id" => $author->id
      ]);

      $userPost = Post::create([
        "title" => "user title post",
        "text" => "text of user post",
        "user_id" => $user->id
      ]);

      Comment::truncate();
      // comments and relationship with posts and users (commenting on Admin Post)
      $adminComment = Comment::create([
        "text" => "im admin!",
        "user_id" => $admin->id,
        "post_id" => $adminPost->id
      ]);

      $authorComment = Comment::create([
        "text" => "im author!",
        "user_id" => $author->id,
        "post_id" => $adminPost->id
      ]);

      $userComment = Comment::create([
        "text" => "im user!",
        "user_id" => $user->id,
        "post_id" => $adminPost->id
      ]);


    }
}
