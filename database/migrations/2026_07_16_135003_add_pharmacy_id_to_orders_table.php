<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPharmacyIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->unsignedBigInteger('pharmacy_id')
                  ->nullable()
                  ->after('user_id');

            $table->foreign('pharmacy_id')
                  ->references('id')
                  ->on('pharmacies')
                  ->onDelete('cascade');

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

            $table->dropForeign(['pharmacy_id']);

            $table->dropColumn('pharmacy_id');

        });
    }
}