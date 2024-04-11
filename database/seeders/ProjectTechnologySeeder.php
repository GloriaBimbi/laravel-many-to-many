<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();
        $technologies = Technology::all()->pluck('id');

        // faccio in modo che ogni post abbia un tot di tags attaccati ma scelti randomicamente
        foreach($projects as $project){
            // creo un array di elementi randomici dentro l'array passato da 1 a 5
            $random_technologies = $faker->randomElements($technologies, rand(1,5));
            // con il sync faccio automaticamente il detach (quindi di tutti i collegamenti) e l'attach di quelli specificati tra parentesi
            $project->technologies()->sync($random_technologies);
        }

    }
}
