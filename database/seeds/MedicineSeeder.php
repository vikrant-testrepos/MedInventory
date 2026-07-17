<?php

use Illuminate\Database\Seeder;
use App\Medicine;
use App\Category;
use App\Pharmacy;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $medicines = [

            ['Paracetamol 500mg','GSK','Pain Relief',120,120,'Effective pain relief and fever reducer.'],
            ['Ibuprofen 400mg','Sun Pharma','Pain Relief',180,80,'Relieves pain and inflammation.'],
            ['Crocin Advance','GSK','Pain Relief',90,150,'Fast acting fever medicine.'],
            ['Dolo 650','Micro Labs','Pain Relief',140,95,'Relieves body pain and fever.'],

            ['Amoxicillin 500mg','Cipla','Antibiotics',260,75,'Broad spectrum antibiotic.'],
            ['Azithromycin 500mg','Pfizer','Antibiotics',420,60,'Treats bacterial infections.'],
            ['Cefixime 200mg','Lupin','Antibiotics',390,55,'Used for respiratory infections.'],

            ['Vitamin C Tablets','Himalaya','Vitamins',240,200,'Boosts immunity.'],
            ['Zinc Tablets','Abbott','Vitamins',210,140,'Supports immune system.'],
            ['Multivitamin','Centrum','Vitamins',650,110,'Daily nutritional supplement.'],
            ['Evion 400','Merck','Vitamins',380,95,'Vitamin E capsules.'],

            ['Metformin 500mg','USV','Diabetes',160,130,'Controls blood sugar.'],
            ['Insulin Pen','Novo Nordisk','Diabetes',1500,25,'Insulin injection pen.'],
            ['Gluconorm','Lupin','Diabetes',280,70,'Diabetes management tablets.'],

            ['Amlodipine 5mg','Cipla','Heart Care',240,85,'Controls blood pressure.'],
            ['Atorvastatin','Pfizer','Heart Care',350,90,'Reduces cholesterol.'],
            ['Ecosprin 75','USV','Heart Care',110,160,'Blood thinner.'],

            ['Baby Lotion','Johnson & Johnson','Baby Care',420,75,'Moisturizes baby skin.'],
            ['Baby Shampoo','Johnson & Johnson','Baby Care',390,85,'Gentle baby shampoo.'],

            ['Liv52','Himalaya','Herbal',250,100,'Supports liver health.'],
            ['Ashwagandha','Dabur','Herbal',520,80,'Improves energy and immunity.'],
            ['Tulsi Drops','Patanjali','Herbal',190,90,'Natural immunity booster.'],

            ['Cetaphil Cleanser','Galderma','Skin Care',980,40,'Gentle facial cleanser.'],
            ['Moisturizing Cream','Nivea','Skin Care',560,60,'Keeps skin hydrated.'],
            ['Acne Gel','Himalaya','Skin Care',320,65,'Helps reduce acne.'],

            ['ORS Powder','Electral','Vitamins',40,250,'Prevents dehydration.'],
            ['Benadryl Syrup','Johnson','Pain Relief',220,55,'Relieves cough.'],
            ['Digene Tablets','Abbott','Pain Relief',180,90,'Antacid tablets.'],
            ['Vicks Vaporub','Vicks','Pain Relief',170,120,'Relieves cold symptoms.'],
            ['Volini Spray','Sun Pharma','Pain Relief',430,45,'Pain relief spray.']

        ];

        $pharmacies = Pharmacy::all();

        foreach ($medicines as $item) {

            $category = Category::where('name', $item[2])->first();

            Medicine::create([

                'pharmacy_id' => $pharmacies->random()->id,

                'category_id' => $category ? $category->id : 1,

                'name' => $item[0],

                'company' => $item[1],

                'price' => $item[3],

                'quantity' => $item[4],

                'description' => $item[5],

                'image' => null

            ]);

        }
    }
}