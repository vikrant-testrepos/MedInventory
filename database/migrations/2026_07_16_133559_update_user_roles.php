<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateUserRoles extends Migration
{
    public function up()
    {
        // SQLite does not support ALTER TABLE ... MODIFY COLUMN syntax.
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'pharmacy',
                'patient'
            ) DEFAULT 'patient'
        ");
    }

    public function down()
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'patient'
            ) DEFAULT 'patient'
        ");
    }
}
