<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuong', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('truyen_id');
            $table->bigInteger('user_id');
            $table->integer('numchap');
            $table->string('name', 255);
            $table->text('content')->nullable();
            $table->string('public', 1)->default('Y');
            $table->string('lock', 1)->default('N');
            $table->double('view')->default(0);
            $table->double('like')->default(0);
            $table->integer('number_letters')->default(0);
            $table->dateTime('auto_post')->nullable();
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
        Schema::dropIfExists('chuong');
    }
}
