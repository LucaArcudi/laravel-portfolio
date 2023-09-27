<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i=0; $i < 8 ; $i++)  { 
            $newSkill = new Skill();
            $newSkill->name = $faker->unique()->word();
            $newSkill->slug = Str::slug($newSkill->name);
            $newSkill->image = $faker->imageUrl();
            $newSkill->save();
            $newSkill->slug = $newSkill->slug.'-'.$newSkill->id;
            $newSkill->update();
        }
    }
}
