<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_systems', function (Blueprint $table) {
            $table->id();
            $table->string('baotri', 1)->default('N');
            $table->string('craw', 1)->default('N');
            $table->string('google_login', 1)->default('N');
            $table->string('facebook_login', 1)->default('N');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_systems');
    }
}
