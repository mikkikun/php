<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(Favorites_CommentsTableSeeder::class);
        $this->call(Favorites_ReplieTableSeeder::class);
        $this->call(FollowersTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
    }
}
