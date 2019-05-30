<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhCnMhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_cn_mh', function (Blueprint $table) {
            $table->integer('kh_cn_id')->unsigned();
            $table->integer('mh_id')->unsigned();
            $table->string('status')->nullable();
            $table->foreign('mh_id')->references('id')->on('monhoc')->onDelete('CASCADE');
            $table->foreign('kh_cn_id')->references('id')->on('kh_cn')->onDelete('CASCADE');
            $table->primary(['kh_cn_id','mh_id']);
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
        Schema::dropIfExists('kh_cn_mh');
    }
}
