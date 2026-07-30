<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInventoryFieldsToMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {

            // These columns may already exist from an earlier migration.
            if (! Schema::hasColumn('medicines', 'cost_price')) {
                $table->decimal('cost_price', 8, 2)->default(0)->after('company');
            }

            if (! Schema::hasColumn('medicines', 'batch_number')) {
                $table->string('batch_number')->nullable()->after('quantity');
            }

            if (! Schema::hasColumn('medicines', 'expiry_date')) {
                $table->date('expiry_date')->nullable()->after('batch_number');
            }

        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('medicines', 'cost_price')) {
                $columns[] = 'cost_price';
            }
            if (Schema::hasColumn('medicines', 'batch_number')) {
                $columns[] = 'batch_number';
            }
            if (Schema::hasColumn('medicines', 'expiry_date')) {
                $columns[] = 'expiry_date';
            }

            if (! empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
}
