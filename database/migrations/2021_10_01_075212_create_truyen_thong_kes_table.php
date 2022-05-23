<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruyenThongKesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truyen_thong_ke', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('truyen_id');
            $table->double('views');
            $table->double('vote');
            $table->date('curr_date')->default(date('Y-m-d'));
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
        Schema::dropIfExists('truyen_thong_ke');
    }
}
