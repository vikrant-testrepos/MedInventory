<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessFieldsToMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $table->decimal('cost_price',10,2)
                  ->default(0)
                  ->after('price');

            $table->string('batch_number')
                  ->nullable()
                  ->after('cost_price');

            $table->date('expiry_date')
                  ->nullable()
                  ->after('batch_number');

        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $table->dropColumn([
                'cost_price',
                'batch_number',
                'expiry_date'
            ]);

        });
    }
}