<?php

namespace Database\Seeders;

use App\Models\QuotationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = app('translatable.locales')->all();

        $statuses = [
            'Draft', 'Sent', 'History', 'Interrupted',
        ];

        foreach($statuses as $status) {
            $data = [];
            foreach($locales as $locale) {
                $data[$locale]['name'] = $status;
            }

            QuotationStatus::create($data);
        }
    }
}
