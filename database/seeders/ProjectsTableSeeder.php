<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 60; $i++) {
            $newProjects = new Project();
            $newProjects->title = $faker->sentence(2);
            $newProjects->technologies = $faker->sentence(3);
            $newProjects->description = $faker->text();
            $newProjects->date = $faker->date();
            $newProjects->save();
        }
    }
}
