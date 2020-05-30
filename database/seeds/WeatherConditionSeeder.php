<?php

use App\WeatherCondition;
use Illuminate\Database\Seeder;

class WeatherConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeatherCondition::insert([
            [ 'name' => 'clear', 'description' => 'clear' ],
            [ 'name' => 'isolated-clouds', 'description' => 'light clouds' ],
            [ 'name' => 'scattered-clouds', 'description' => 'cloudy with clear spells' ],
            [ 'name' => 'overcast', 'description' => 'cloudy' ],
            [ 'name' => 'light-rain', 'description' => 'light rain' ],
            [ 'name' => 'moderate-rain', 'description' => 'rain' ],
            [ 'name' => 'heavy-rain', 'description' => 'heavy rain' ],
            [ 'name' => 'sleet', 'description' => 'wet mud' ],
            [ 'name' => 'light-snow', 'description' => 'light snow' ],
            [ 'name' => 'moderate-snow', 'description' => 'snow' ],
            [ 'name' => 'heavy-snow', 'description' => 'heavy snow' ],
            [ 'name' => 'fog', 'description' => 'fog' ],
            [ 'name' => 'na', 'description' => 'weather conditions not determined' ]
        ]);
    }
}
