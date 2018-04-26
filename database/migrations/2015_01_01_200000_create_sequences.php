<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" CREATE SEQUENCE semsop_relatorios_numero START 1 ");
        DB::statement(" CREATE SEQUENCE semus_relatorios_numero START 1 ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(" DROP SEQUENCE semsop_relatorios_numero ");
        DB::statement(" DROP SEQUENCE semus_relatorios_numero ");
    }
}
