<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $admin = $this->createAdmin();
        $this->seedArticles($admin);
        $this->seedUsers();
        $this->seedComments();

    }

    /**
     * Seed main admin user as defined in .env
     * 
     * @return User $admin
     */
    private function createAdmin()
    {

        $admin = new User;
        $admin->role = 'admin';
        $admin->name = env("ADMIN_NAME");
        $admin->email = env('ADMIN_EMAIL');
        $admin->password = Hash::make(env('ADMIN_PASSWORD'));
        $admin->email_verified_at = now();
        $admin->save();
        return $admin;
        
    }

    /**
     * Seed articles for development purposes. Don't run this seed for production.
     * 
     * @return void
     */
    private function seedArticles(User $admin)
    {

        $admin->articles()->saveMany(Article::factory()->count(20)->make());

    }

    /**
     * Seed users for development purposes. Don't run this seed for production.
     * 
     * @return void
     */
    private function seedUsers()
    {

        User::factory(30)->create();

    }

    /**
     * Seed comments for development purposes. Don't run this seed for production.
     * 
     * @return void
     */
    private function seedComments()
    {

        Article::each(function($article) {

            $article->comments()->saveMany(Comment::factory()->count(5)->make());
            
            $article->comments()->each(function($comment) {

                $comment->replies()->saveMany(Comment::factory()->count(2)->make([
                    'article_id' => $comment->article()->first()->id
                ]));

            });

        });

    }
}
