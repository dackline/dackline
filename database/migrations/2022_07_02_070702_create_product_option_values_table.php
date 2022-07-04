<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('option_id')->constrained();
            $table->foreignId('option_value_id')->constrained();
            $table->unsignedInteger('quantity')->default(1);
            $table->tinyInteger('subtract')->default(0);
            $table->decimal('price', 15, 4)->default(0);
            $table->string('price_prefix', 1)->default('+');
            $table->decimal('weight', 15, 4)->default(0);
            $table->string('weight_prefix', 1)->default('+');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_option_values');
    }
};
