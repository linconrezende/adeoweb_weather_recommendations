<?php

use Illuminate\Database\Seeder;
use SebastianBergmann\Environment\Console;

class WhetherProductRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get all whether conditions
        $conditions = App\WhetherCondition::get();
        
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
                    $rec = App\WhetherProductRecommendation::create([
                        'product_id' => $p->id,
                        'whether_condition_id' => $c->id
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
