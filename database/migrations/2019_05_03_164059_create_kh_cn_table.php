<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhCnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_cn', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kh_id')->unsigned();
            $table->integer('cn_id')->unsigned();
            $table->foreign('kh_id')->references('id')->on('khoahoc')->onDelete('CASCADE');
            $table->foreign('cn_id')->references('id')->on('chuyennganh')->onDelete('CASCADE');
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
        Schema::dropIfExists('kh_cn');
    }
}
