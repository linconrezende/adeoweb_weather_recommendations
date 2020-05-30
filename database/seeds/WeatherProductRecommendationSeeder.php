<?php

use Illuminate\Database\Seeder;
use SebastianBergmann\Environment\Console;

class WeatherProductRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get all weather conditions
        $conditions = App\WeatherCondition::get();
        
        DB::beginTransaction();
        try {
            // how much products will be created
            foreach ($conditions as $key => $c) {
                //foreach condition create a random number of products
                $howMany = rand(1, 6);
                $listProducts = [];
                for ($i=0; $i < $howMany; $i++) {
                    $prod = factory(App\Product::class)->make();
                    $prod->save();
                    array_push($listProducts, $prod);
                }
                
                foreach ($listProducts as $key => $p) {
                    $rec = App\WeatherProductRecommendation::create([
                        'product_id' => $p->id,
                        'weather_condition_id' => $c->id
                    ]);
                }
            }
            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            throw $e;
        }
    }
}
