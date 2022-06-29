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
        Schema::create('information_details', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('information_id')->constrained();
            $table->unique(['information_id','locale']);
            $table->string('title');
            $table->text('description');
            $table->string('meta_title');
            $table->text('meta_description')->nullable();
            $table->string('url', 2083);
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
        Schema::dropIfExists('information_details');
    }
};
