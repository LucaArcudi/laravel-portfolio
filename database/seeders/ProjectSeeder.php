<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $newProjects = new Project();
            $newProjects->category_id = Category::inRandomOrder()->first()->id;
            $newProjects->title = $faker->sentence(2);
            $newProjects->slug = Str::slug($newProjects->title);
            $newProjects->image = $faker->imageUrl();
            $newProjects->description = $faker->text();
            $newProjects->save();
        }
    }
}