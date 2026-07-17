<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeOrderStatusEnum extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'Pending',
                'Preparing',
                'Delivered',
                'Cancelled'
            ) DEFAULT 'Pending'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'Pending',
                'Approved',
                'Delivered'
            ) DEFAULT 'Pending'
        ");
    }
}