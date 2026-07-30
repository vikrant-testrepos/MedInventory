<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeOrderStatusEnum extends Migration
{
    public function up()
    {
        // SQLite does not support ALTER TABLE ... MODIFY COLUMN syntax.
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

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
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

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
