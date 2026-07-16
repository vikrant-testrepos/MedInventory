<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckoutFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('phone')->after('total_price');

            $table->string('district')->after('phone');

            $table->text('address')->after('district');

            $table->enum('payment_method', [
                'Cash on Delivery',
                'eSewa',
                'Khalti'
            ])->after('address');

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

            $table->dropColumn([
                'phone',
                'district',
                'address',
                'payment_method'
            ]);

        });
    }
}