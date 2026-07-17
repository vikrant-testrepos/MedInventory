<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('medicine_id');

            $table->string('batch_no');

            $table->string('supplier')->nullable();

            $table->integer('stock');

            $table->decimal('purchase_price',8,2);

            $table->decimal('selling_price',8,2);

            $table->date('expiry_date');

            $table->timestamps();

            $table->foreign('medicine_id')
                ->references('id')
                ->on('medicines')
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
        Schema::dropIfExists('inventories');
    }
}
