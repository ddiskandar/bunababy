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
            $table->string('no_reg')->unique();
            $table->string('invoice')->unique();
            $table->tinyInteger('place')->default(1);
            $table->foreignId('client_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('midwife_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('address_id')->constrained()->nullable();
            $table->integer('total_price');
            $table->integer('total_duration');
            $table->integer('total_transport');
            $table->integer('additional')->default(0);
            $table->timestamp('start_datetime');
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
