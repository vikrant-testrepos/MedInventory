<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateUserRoles extends Migration
{
    public function up()
    {
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
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'patient'
            ) DEFAULT 'patient'
        ");
    }
}