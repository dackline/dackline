<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_status_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });

        $keyExists = DB::select(
            DB::raw(
                'SHOW KEYS
                FROM orders
                WHERE Key_name=\'orders_order_status_id_foreign\''
            )
        );

        if($keyExists) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign('orders_order_status_id_foreign');
                $table->dropColumn('order_status_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_data');
    }
};
