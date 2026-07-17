<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_histories', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('medicine_id');

            $table->unsignedBigInteger('inventory_id')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('action');

            $table->integer('quantity');

            $table->integer('stock_before');

            $table->integer('stock_after');

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->foreign('medicine_id')
                ->references('id')
                ->on('medicines')
                ->onDelete('cascade');

            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onDelete('set null');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_histories');
    }
}
