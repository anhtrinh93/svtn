<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinhvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masv');
            $table->string('hoten');
            $table->date('ngaysinh');
            $table->integer('kh_id')->unsigned();
            $table->foreign('kh_id')->references('id')->on('khoahoc')->onDelete('CASCADE');
            $table->integer('cn_id')->unsigned();
            $table->foreign('cn_id')->references('id')->on('chuyennganh')->onDelete('CASCADE');
            $table->string('lophoc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinhvien');
    }
}
