<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string("label")->nullable();
            $table->integer("count")->default(0);
            $table->integer('year')->default(2023);
            $table->string("color")->default('#eb16164d');
            $table->integer('type')->default(1);
            // 1-sirketqiymetlendirmesi
            // 2-sehmveistiqrazlar
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
        Schema::dropIfExists('counters');
    }
};
