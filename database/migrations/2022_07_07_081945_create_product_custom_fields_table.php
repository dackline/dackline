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
        Schema::create('product_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('supplier_id')->nullable();
            $table->string('manufacture_date')->nullable();
            $table->string('width')->nullable();
            $table->string('size')->nullable();
            $table->string('purchase_price')->nullable();

            $table->string('wheel_color')->nullable();
            $table->string('wheel_et')->nullable();
            $table->string('wheel_center_bore')->nullable();
            $table->string('wheel_max_load')->nullable();
            $table->json('wheel_pcd')->nullable();

            $table->string('tyre_holohation_mark')->nullable();
            $table->string('tyre_profile')->nullable();
            $table->string('tyre_construction_type')->nullable();
            $table->string('tyre_load_index')->nullable();
            $table->string('tyre_speed_rating')->nullable();
            $table->string('tyre_c_flag')->nullable();
            $table->string('tyre_category_info')->nullable();
            $table->string('tyre_runflat_rtf')->nullable();
            $table->string('tyre_snowigan')->nullable();
            $table->string('tyre_studded')->nullable();
            $table->string('tyre_label_roll')->nullable();
            $table->string('tyre_label_wet')->nullable();
            $table->string('tyre_label_noise_1')->nullable();
            $table->string('tyre_label_noise_2')->nullable();

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
        Schema::dropIfExists('product_custom_fields');
    }
};
