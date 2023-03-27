<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('no_reg')->unique();
            $table->string('invoice')->unique();
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade');
            $table->foreignId('room_id')->nullable();
            $table->foreignId('client_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('midwife_user_id')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->integer('total_price');
            $table->integer('total_duration')->default(0);
            $table->integer('total_transport')->default(0);
            $table->integer('adjustment_amount')->default(0);
            $table->string('adjustment_name')->nullable();
            $table->timestamp('start_datetime')->nullable();
            $table->timestamp('end_datetime')->nullable();
            $table->string('screening')->nullable();
            $table->tinyInteger('status')->default(2);
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
