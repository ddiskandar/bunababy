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
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('midwife_id')->constrained('midwives')->cascadeOnDelete();
            $table->foreignId('address_id')->nullable();
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('total_duration')->default(0);
            $table->unsignedInteger('total_transport')->default(0);
            $table->integer('adjustment_amount')->default(0);
            $table->string('adjustment_name')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('screening')->nullable();
            $table->text('report')->nullable();
            $table->tinyInteger('status')->default(OrderStatus::BOOKED);
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
};
