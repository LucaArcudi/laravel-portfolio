<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();

        $skillIds = Skill::all()->pluck('id');

        foreach ($projects as $project) {
            $project->skills()->withTimestamps()->attach($faker->randomElements($skillIds, 3));
        }
    }
}
