<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
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
            'Canceled', 'Chargeback', 'Complete', 'Denied', 'Expired', 'Failed', 'selected', 'Processed', 'Processing', 'Refunded', 'Reversed', 'Shipped', 'Voided',
        ];

        foreach($statuses as $status) {
            $data = [];
            foreach($locales as $locale) {
                $data[$locale]['name'] = $status;
            }

            OrderStatus::create($data);
        }
    }
}
