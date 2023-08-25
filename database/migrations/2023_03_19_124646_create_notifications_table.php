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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');

            $table->string('value')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->integer('via');
            // 1- mail
            // 2- sms
            $table->boolean('status')->default(false);
            // false
            // true

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
        Schema::dropIfExists('notifications');
    }
};
