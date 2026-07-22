<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchasePriceToMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $table->decimal('purchase_price', 10, 2)
                  ->default(0)
                  ->after('company');

        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $table->dropColumn('purchase_price');

        });
    }
}