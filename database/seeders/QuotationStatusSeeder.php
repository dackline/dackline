<?php

namespace Database\Seeders;

use App\Models\QuotationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // remove old statuses if any
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('quotation_status_translations')->truncate();
        DB::table('quotation_statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $locales = app('translatable.locales')->all();

        $statuses = [
            'Draft', 'Sent', 'History', 'Cancelled',
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
