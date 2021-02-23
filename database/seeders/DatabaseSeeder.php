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

    private function seedArticles(User $admin)
    {
        $admin->articles()->saveMany(Article::factory()->count(20)->make());
    }

    private function seedUsers()
    {
        User::factory(30)->create();
    }

    private function seedComments()
    {
        $articles = Article::get();
        foreach($articles as $article)
        {
            $article->comments()->saveMany(Comment::factory()->count(5)->make());
            foreach($article->comments() as $comment)
            {
                $comment->replies()->saveMany(Comment::factory()->count(2)->make());
            }
        }
    }
}
