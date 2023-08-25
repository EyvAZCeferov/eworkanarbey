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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            $table->float('amount')->default(0);
            $table->string('transaction_id')->nullable();
            $table->integer('payment_status')->default(0);
            // 0 not payed
            // 1 payed

            $table->json('data')->nullable();
            $table->json('frompayment')->nullable();
            $table->string('end_time')->nullable();

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
        Schema::dropIfExists('payments');
    }
};
