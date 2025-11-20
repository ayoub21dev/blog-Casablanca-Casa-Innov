<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Health', 'slug' => 'health'],
            ['name' => 'Science', 'slug' => 'science'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $cats = Category::all();

        foreach ($cats as $cat) {
            Article::factory(10)->create([
                'user_id' => $user->id,
                'category_id' => $cat->id,
                'status' => 'published',
            ]);
        }
        
        // Create some draft articles
        Article::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $cats->random()->id,
            'status' => 'draft',
        ]);
    }
}
