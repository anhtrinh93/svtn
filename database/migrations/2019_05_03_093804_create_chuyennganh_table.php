<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChuyennganhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuyennganh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('macn');
            $table->string('tencn');
            $table->integer('khoa_id')->unsigned();
            $table->foreign('khoa_id')->references('id')->on('khoa')->onDelete('CASCADE');
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
        Schema::dropIfExists('chuyennganh');
    }
}
