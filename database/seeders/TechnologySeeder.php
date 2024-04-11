<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technology_data = ['Git', 'HTML5', 'CSS3', 'Bootstrap', 'JavaScript ES5', 'vueJS 3', 'Axios', 'RESTful API', 'SQL', 'PHP', 'Json', 'Laravel', 'Blade', 'Eloquent', 'Faker'];
            foreach($technology_data as $_technology){
                $tag = new Technology;
                $tag->label = $_technology;
                $tag->color = $faker->hexColor();
                $tag->save();
            }
    }
}
