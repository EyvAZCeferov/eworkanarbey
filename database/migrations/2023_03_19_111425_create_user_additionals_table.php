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
        Schema::create('user_additionals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');

            $table->string("company_name")->nullable();
            $table->string("company_owner_name")->nullable();
            $table->string("company_legal_owner")->nullable();
            $table->string("company_version")->nullable();
            // QSC
            // MMC

            $table->text("company_description")->nullable();
            $table->string("company_voen")->nullable();
            $table->string('company_logo')->nullable();
            $table->text("activity_area")->nullable();


            $table->string("original_password")->nullable();
            $table->timestamp("registry_date")->nullable();
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
        Schema::dropIfExists('user_additionals');
    }
};
