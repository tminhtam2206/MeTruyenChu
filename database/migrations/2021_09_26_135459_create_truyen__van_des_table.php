<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruyenVanDesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truyen_van_de', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('truyen_id');
            $table->bigInteger('user_id');
            $table->string('problem', 255);
            $table->string('check', 1)->default('N');
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
        Schema::dropIfExists('truyen_van_de');
    }
}
