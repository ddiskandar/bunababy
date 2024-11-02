<?php

use App\Enums\OrderStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->startingValue(1002347811);
            $table->foreignId('place_id')->constrained('places')->cascadeOnDelete();
            $table->foreignId('room_id')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('midwife_id')->constrained('midwives')->cascadeOnDelete();
            $table->foreignId('address_id')->nullable();
            $table->json('treatments')->nullable();
            $table->unsignedInteger('transport')->default(0);
            $table->integer('adjustment_amount')->default(0);
            $table->string('adjustment_name')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->json('screening')->nullable();
            $table->json('report')->nullable();
            $table->tinyInteger('status')->default(OrderStatus::BOOKED);
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
};
