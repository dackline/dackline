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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('article_nr');
            $table->string('ean')->nullable();
            $table->string('sku')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price', 15, 4)->default(0);
            $table->foreignId('tax_id')->nullable()->constrained();
            $table->foreignId('manufacturer_id')->nullable()->constrained();
            $table->string('url', 2083)->nullable();
            $table->string('design_template')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('minimum_quantity')->default(1);
            $table->unsignedTinyInteger('subtract')->default(0);
            $table->foreignId('stock_status_id')->nullable()->constrained();
            $table->date('date_available')->nullable();
            $table->decimal('weight', 15, 8)->default(0);
            $table->integer('sort_order')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
