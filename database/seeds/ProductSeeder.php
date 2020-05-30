<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listProducts = factory(App\Product::class, 100)->make()->toArray();
        App\Product::insert($listProducts);
    }
}
