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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('geo_zone_id')->index()->nullable()->constrained()->onDelete('set null');
            $table->foreignId('store_id')->index()->nullable()->constrained()->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('total', 15, 4)->default(0);
            $table->decimal('cost', 15, 4)->default(0);
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
        Schema::dropIfExists('shipping_methods');
    }
};
