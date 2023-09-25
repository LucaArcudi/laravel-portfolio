<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{   

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $dummyUser = new User();
        $dummyUser->name = 'Dummy';
        $dummyUser->email = 'dummy@dummy.com';
        $dummyUser->password = Hash::make('dummydummy');
        $dummyUser->save();


        for ($i=0; $i < 9 ; $i++) { 
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->unique()->email();
            $newUser->password = Hash::make($faker->password());
            $newUser->save();
        }
    }
}
