<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPharmacyIdToMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $table->unsignedBigInteger('pharmacy_id')->nullable()->after('id');

            $table->foreign('pharmacy_id')
                  ->references('id')
                  ->on('pharmacies')
                  ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $table->dropForeign(['pharmacy_id']);

            $table->dropColumn('pharmacy_id');

        });
    }
}