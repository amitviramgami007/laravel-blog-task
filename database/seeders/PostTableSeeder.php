<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::pluck('id')->toArray();

        for ($i = 0; $i < 500; $i++)
        {
            $post = Post::create([
                'title' => $faker->paragraph(1),
                'user_id' => User::all()->random()->id,
                'created_by' => User::all()->random()->id,
                'updated_by' => User::all()->random()->id,
            ]);

            $category_random = array_rand($categories, 1);
            $post->categories()->attach($categories[$category_random]);
        }
    }
}
