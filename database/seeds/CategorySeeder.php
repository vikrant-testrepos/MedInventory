<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $legacyNames = [
            'ज्वरो तथा दुखाइ', 'एन्टिबायोटिक', 'भिटामिन तथा पोषण',
            'मधुमेह हेरचाह', 'रक्तचाप तथा मुटु', 'बाल स्वास्थ्य',
            'छाला तथा सौन्दर्य', 'पाचन स्वास्थ्य', 'श्वासप्रश्वास स्वास्थ्य',
            'आयुर्वेदिक तथा हर्बल',
        ];

        Category::whereIn('name', $legacyNames)->delete();

        foreach ([
            'Pain and Fever Relief',
            'Antibiotics',
            'Vitamins and Nutrition',
            'Diabetes Care',
            'Blood Pressure and Heart Care',
            'Child Health',
            'Skin and Personal Care',
            'Digestive Health',
            'Respiratory Care',
            'Ayurvedic and Herbal',
        ] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
