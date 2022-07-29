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
            'New order', 'Processing', 'Awaiting client', 'Awaiting Dackline', 'Reject', 'Sent',
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
