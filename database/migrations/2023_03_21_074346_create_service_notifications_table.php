<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references("id")->on("services")->onDelete('cascade');
            
            $table->json('name')->nullable();
            $table->json('slugs')->nullable();
            $table->json("description")->nullable();
            $table->boolean('status')->default(false);
            $table->string('pdf')->nullable();
            $table->timestamp('time')->default(DB::raw('CURRENT_TIMESTAMP'));
            
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
        Schema::dropIfExists('service_notifications');
    }
};
