<?php

use Illuminate\Database\Seeder;
use App\Film;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //Get the films
        $films_ids = DB::table('films')->pluck('id');
        $user = DB::table('users')->where('id', 1)->first();
        //foreach film, add a comment
		foreach ($films_ids as $film_id) {
		     DB::table('comments')->insert([
                'user_id' => 1, //assume the first user
                'film_id' => $film_id,
                'user_name' => $user->name,
                'comment' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
            ]);
		}
    }
}
