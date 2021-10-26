<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_resep', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bahan_id');
            $table->unsignedSmallInteger('resep_id');
            $table->timestamps();
            
            $table->foreign('bahan_id')->references('id')->on('bahan');
            $table->foreign('resep_id')->references('id')->on('resep');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_resep');
    }
}
