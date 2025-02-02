<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Remove user_id
            $table->dropColumn('user_id');

            // Delivery Information
            $table->string('delivery_country')->nullable();
            $table->string('delivery_firstname')->nullable();
            $table->string('delivery_lastname')->nullable();
            $table->string('delivery_company')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_apartment')->nullable();
            $table->string('delivery_postcode')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_phone')->nullable();
            $table->boolean('delivery_save_data')->default(false);
            $table->boolean('delivery_sms_offers')->default(false);

            // Billing Information
            $table->string('billing_country')->nullable();
            $table->string('billing_firstname')->nullable();
            $table->string('billing_lastname')->nullable();
            $table->string('billing_company')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_apartment')->nullable();
            $table->string('billing_postcode')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_phone')->nullable();

            // Payment and Additional Info
            $table->string('payment')->nullable();
            $table->string('contact_email_or_phone')->nullable();
            $table->boolean('contact_newsletter')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add user_id back
            $table->unsignedBigInteger('user_id')->nullable();

            // Remove all newly added fields
            $table->dropColumn([
                'delivery_country',
                'delivery_firstname',
                'delivery_lastname',
                'delivery_company',
                'delivery_address',
                'delivery_apartment',
                'delivery_postcode',
                'delivery_city',
                'delivery_phone',
                'delivery_save_data',
                'delivery_sms_offers',
                'billing_country',
                'billing_firstname',
                'billing_lastname',
                'billing_company',
                'billing_address',
                'billing_apartment',
                'billing_postcode',
                'billing_city',
                'billing_phone',
                'payment',
                'contact_email_or_phone',
                'contact_newsletter',
            ]);
        });
    }
}
