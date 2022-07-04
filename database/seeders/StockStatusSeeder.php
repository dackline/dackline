<?php

namespace Database\Seeders;

use App\Models\StockStatus;
use Astrotomic\Translatable\Locales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'sv' => [
                'I lager',
                'Ej i lager',
                'Extern lager (5-7 dagar)',
                'Utgått'
            ],
            'en' => [
                'In stock',
                'Out of stock',
                'External stock (5-7 days)',
                'Expired'
            ],
        ];

        $locales = app(Locales::class)->all();

        for($i = 0; $i < 4; $i++) {
            $data = [];
            foreach($locales as $locale) {
                $data[$locale] = ['name' => $statuses[$locale][$i]];
            }

            StockStatus::create($data);
        }
    }
}
