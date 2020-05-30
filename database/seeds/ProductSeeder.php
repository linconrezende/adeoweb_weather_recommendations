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
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++)
        {
            // Creating a product name with a color
            $_name = [];
            array_push($_name, ucfirst($faker->colorName));
            $_secondName = $faker->word();
            // Faker word sometimes return words with only 2 characters. We need at least 2 characters of length to properly create the SKU. For now I will use at least 5
            while (strlen($_secondName) < 5) {
                $_secondName = $faker->word();
            }
            array_push($_name, ucfirst($_secondName));

            // SKU generated with the first 2 letters of the second part of the product name and random numbers (IT SHOULD be unique but it's not for this purpose)
            $_sku = [];
            array_push($_sku, strtoupper(substr($_name[1], 0, 2)));
            array_push($_sku, $faker->randomNumber(7));
            
            try {
                $prod = App\Product::create([
                    'sku' =>  join('-', $_sku), // Join the product sku array with a dash between the strings
                    'name' => join(' ', $_name), // Join the product name array with a space between the strings
                    'price' => $faker->randomFloat(2, 5, 450) // Random price (max 2 decimals as it is defined on the migration)
                ]);
            } catch (\Throwable $th) {
                // Ignore errors for now. It should be treated to ignore errors of unique key in case of SKU becoming unique.
            }
        }
    }
}
