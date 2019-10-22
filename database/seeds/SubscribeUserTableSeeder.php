<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscribeUserTableSeeder extends Seeder
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

            DB::table('user_subscribe')->insert([
                'user_id' => $faker->unique()->numberBetween(1,15),
                'subscribe_end' => $faker->unixTime
            ]);
        }

    }
}
