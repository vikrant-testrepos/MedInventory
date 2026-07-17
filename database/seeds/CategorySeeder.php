<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Pain Relief',
            'Antibiotics',
            'Vitamins',
            'Diabetes',
            'Heart Care',
            'Baby Care',
            'Skin Care',
            'Herbal'
        ];

        foreach ($categories as $category) {

            Category::firstOrCreate([
                'name' => $category
            ]);

        }
    }
}