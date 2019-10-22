<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<15;$i++) {

            DB::table('users')->insert([
                'login' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->firstName,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);
        }

    }
}
