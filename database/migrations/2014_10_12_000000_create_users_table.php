<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 42)->unique();
            $table->string('display_name', 42)->default('Tên Hiển Thị');
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->double('exp')->default(10);
            $table->string('exp_level', 40)->default('Phàm Nhân'); //Kim Dan So Ky
            $table->double('coin')->default(10);
            $table->string('lock', 1)->default('N');
            $table->string('role', 6)->default('member'); //member mode admin
            $table->string('avatar', 255)->default('default-avatar.jpeg');
            $table->string('avatar_cover', 255)->default('default.jpeg');
            $table->integer('truyen_da_dang')->default(0);
            $table->integer('tu_truyen')->default(0);
            $table->integer('binh_luan')->default(0);
            $table->string('status', 300)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->engine = "InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
