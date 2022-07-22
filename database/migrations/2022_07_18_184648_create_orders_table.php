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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained()->onDelete('set null');
            $table->string('store_name')->nullable();
            $table->string('store_url')->nullable();

            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('customer_group_id')->nullable()->constrained()->onDelete('set null');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('email_invoice')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('vat_nr')->nullable();

            $table->string('payment_firstname')->nullable();
            $table->string('payment_lastname')->nullable();
            $table->string('payment_company')->nullable();
            $table->string('payment_phone')->nullable();
            $table->string('payment_address_1')->nullable();
            $table->string('payment_address_2')->nullable();
            $table->string('payment_city')->nullable();
            $table->string('payment_zipcode')->nullable();
            $table->string('payment_country')->nullable();
            $table->foreignId('payment_country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->foreignId('payment_method_id')->nullable()->constrained()->onDelete('set null');
            $table->string('payment_method')->nullable();

            $table->string('shipping_firstname')->nullable();
            $table->string('shipping_lastname')->nullable();
            $table->string('shipping_company')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_address_1')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->string('shipping_country')->nullable();
            $table->foreignId('shipping_country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->foreignId('shipping_method_id')->nullable()->constrained()->onDelete('set null');
            $table->string('shipping_method')->nullable();

            $table->string('comment')->nullable();
            $table->decimal('total', 15, 4)->default(0);
            $table->foreignId('order_status_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('assignee_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('ip')->nullable();
            $table->date('delivery_date')->nullable();

            $table->foreignId('currency_id')->nullable()->constrained()->onDelete('set null');
            $table->string('currency_code')->nullable();
            $table->decimal('currency_value', 15, 8)->nullable()->default(1);

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
        Schema::dropIfExists('orders');
    }
};
