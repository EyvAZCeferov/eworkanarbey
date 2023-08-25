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
        Schema::create('service_notification_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_notification_id");
            $table->unsignedBigInteger("attribute_group_id");
            $table->unsignedBigInteger("attribute_id");

            $table->foreign('service_notification_id')->references("id")->on("service_notifications")->onDelete('cascade');
            $table->foreign('attribute_group_id')->references("id")->on("attributes")->onDelete('cascade');
            $table->foreign('attribute_id')->references("id")->on("attributes")->onDelete('cascade');
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
        Schema::dropIfExists('service_notification_attributes');
    }
};
