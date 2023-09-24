<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Front-end',
                'color' => '#540099'
            ],
            [
                'name' => 'Back-end',
                'color' => '#007fff'
            ],
            [
                'name' => 'Full-stack',
                'color' => '#b25d72'
            ]
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->color = $category['color'];
            $newCategory->slug = Str::slug($newCategory->name);
            $newCategory->save();
        }
    }
}
