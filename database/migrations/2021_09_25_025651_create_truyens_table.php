<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truyen', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('name_slug', 255);
            $table->string('cover', 255)->default('cover.jpg');
            $table->string('thumb', 255)->default('thumb.jpg');
            $table->string('author', 255);
            $table->string('type_story', 14);
            $table->string('status', 13)->default('Đang cập nhật');
            $table->text('description')->nullable();
            $table->string('source', 255);
            $table->double('views')->default(0);
            $table->integer('num_chaps')->default(0);
            $table->string('notify', 255)->nullable();
            $table->integer('bookmarks')->default(0);
            $table->integer('vote')->default(0);
            $table->integer('problem')->default(0);
            $table->integer('member')->default(0);
            $table->integer('character')->default(0);
            $table->string('link_craw', 255)->nullable();
            $table->string('auto_craw', 3)->default('NO');
            $table->double('number_letters')->default(0);
            $table->integer('user_id');
            $table->string('public', 1)->default('Y');
            $table->string('lock_comment', 1)->default('N');
            $table->string('lock', 1)->default('N');
            $table->string('delete', 1)->default('N');
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
        Schema::dropIfExists('truyen');
    }
}
