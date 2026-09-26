<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEsewaPaymentFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('transaction_uuid')->nullable()->after('payment_method')->index();
            $table->string('payment_status')->default('unpaid')->after('transaction_uuid');
            $table->string('payment_reference')->nullable()->after('payment_status');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'transaction_uuid',
                'payment_status',
                'payment_reference',
            ]);
        });
    }
}
