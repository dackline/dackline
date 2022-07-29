<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use App\Models\OrderStatusTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
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
        DB::table('order_status_translations')->truncate();
        DB::table('order_statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $locales = app('translatable.locales')->all();

        $statuses = [
            [
                'name' => 'New Order',
                'value' => 'new-order',
            ],
            [
                'name' => 'Processing',
                'value' => 'processing',
            ],
            [
                'name' => 'Awaiting client',
                'value' => 'awaiting-client',
            ],
            [
                'name' => 'Awaiting Dackline',
                'value' => 'awaiting-dackline',
            ],
            [
                'name' => 'Reject',
                'value' => 'reject',
            ],
            [
                'name' => 'Sent',
                'value' => 'sent',
            ],
        ];

        foreach($statuses as $status) {
            $data = [
                'value' => $status['value']
            ];

            foreach($locales as $locale) {
                $data[$locale]['name'] = $status['name'];
            }

            OrderStatus::create($data);
        }
    }
}
