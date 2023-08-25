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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->json('name')->nullable();
            $table->json('slugs')->nullable();
            $table->json('description')->nullable();

            $table->unsignedBigInteger('top_id')->nullable();
            $table->foreign('top_id')->references("id")->on("services")->onDelete('cascade');

            $table->string('icon')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('send_info')->default(false);
            $table->integer("order_a")->default(1);
            $table->boolean('showondashboard')->default(false);

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
        Schema::dropIfExists('services');
    }
};
