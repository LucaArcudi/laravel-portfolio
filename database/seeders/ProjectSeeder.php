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
            $newProject = new Project();
            $newProject->category_id = Category::inRandomOrder()->first()->id;
            $newProject->title = $faker->sentence(2);
            $newProject->slug = Str::slug($newProject->title);
            $newProject->image = $faker->imageUrl();
            $newProject->description = $faker->text();
            $newProject->save();
            $newProject->slug = $newProject->slug.'-'.$newProject->id;
            $newProject->update();
        }
    }
}
