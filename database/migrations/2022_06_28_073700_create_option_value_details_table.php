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
        Schema::create('option_value_details', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('option_id')->constrained();
            $table->foreignId('option_value_id')->constrained();
            $table->unique(['option_id', 'option_value_id', 'locale']);
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_value_details');
    }
};
