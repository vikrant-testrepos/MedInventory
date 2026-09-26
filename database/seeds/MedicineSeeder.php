<?php

use Illuminate\Database\Seeder;
use App\Medicine;
use App\Category;
use App\Pharmacy;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        Medicine::whereIn('name', [
            'प्यारासिटामोल ५००mg', 'आइबुप्रोफेन ४००mg', 'अमोक्सिसिलिन ५००mg',
            'एजिथ्रोमाइसिन ५००mg', 'भिटामिन C ५००mg', 'जिंक ट्याब्लेट',
            'मेटफर्मिन ५००mg', 'एम्लोडिपिन ५mg', 'ओआरएस पाउडर',
            'खोकीको सिरप', 'बाल मल्हम', 'एलोभेरा जेल', 'त्रिफला चूर्ण',
            'अश्वगन्धा क्याप्सुल', 'एन्टासिड ट्याब्लेट',
        ])->delete();

        $medicines = [
            ['Paracetamol 500mg', 'Nepal Pharma', 'Pain and Fever Relief', 35, 150, 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80'],
            ['Ibuprofen 400mg', 'Deurali Janta', 'Pain and Fever Relief', 75, 90, 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?auto=format&fit=crop&w=800&q=80'],
            ['Amoxicillin 500mg', 'Kantipur Pharma', 'Antibiotics', 180, 80, 'https://images.unsplash.com/photo-1585435557343-3b092031a831?auto=format&fit=crop&w=800&q=80'],
            ['Azithromycin 500mg', 'Lomus Pharmaceuticals', 'Antibiotics', 240, 65, 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80'],
            ['Vitamin C 500mg', 'Himalayan Pharma', 'Vitamins and Nutrition', 220, 120, 'https://images.unsplash.com/photo-1550572017-edd951b55104?auto=format&fit=crop&w=800&q=80'],
            ['Zinc Tablets', 'Nepal Drug Limited', 'Vitamins and Nutrition', 160, 110, 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?auto=format&fit=crop&w=800&q=80'],
            ['Metformin 500mg', 'Magnus Pharma', 'Diabetes Care', 95, 100, 'https://images.unsplash.com/photo-1628771065518-0d82f1938462?auto=format&fit=crop&w=800&q=80'],
            ['Amlodipine 5mg', 'Everest Pharma', 'Blood Pressure and Heart Care', 85, 75, 'https://images.unsplash.com/photo-1580281658223-9b93f18ae9ae?auto=format&fit=crop&w=800&q=80'],
            ['ORS Sachets', 'National Healthcare', 'Digestive Health', 25, 240, 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?auto=format&fit=crop&w=800&q=80'],
            ['Cough Syrup', 'Sumi Pharmaceuticals', 'Respiratory Care', 140, 70, 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80'],
            ['Baby Balm', 'Nepal Medicine', 'Child Health', 95, 80, 'https://images.unsplash.com/photo-1556229010-6c3f2c9ca5f8?auto=format&fit=crop&w=800&q=80'],
            ['Aloe Vera Gel', 'Ayurvedic Nepal', 'Skin and Personal Care', 180, 60, 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?auto=format&fit=crop&w=800&q=80'],
            ['Triphala Powder', 'Singha Durbar Vaidyakhana', 'Ayurvedic and Herbal', 130, 55, 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&w=800&q=80'],
            ['Ashwagandha Capsules', 'Divya Ayurveda', 'Ayurvedic and Herbal', 360, 45, 'https://images.unsplash.com/photo-1542884748-2b87b36c6b90?auto=format&fit=crop&w=800&q=80'],
            ['Antacid Tablets', 'Kathmandu Pharma', 'Digestive Health', 60, 130, 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80'],
        ];

        $pharmacies = Pharmacy::pluck('id')->values();

        foreach ($medicines as $index => $item) {
            Medicine::updateOrCreate(
                ['name' => $item[0]],
                [
                    'pharmacy_id' => $pharmacies->get($index % max($pharmacies->count(), 1)),
                    'category_id' => Category::where('name', $item[2])->value('id'),
                    'company' => $item[1],
                    'price' => $item[3],
                    'cost_price' => round($item[3] * .72, 2),
                    'quantity' => $item[4],
                    'description' => $item[0] . ' available from verified pharmacies in Nepal.',
                    'image' => $item[5],
                ]
            );
        }
    }
}
