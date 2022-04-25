<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_location');
            $table->text('site_desc');
            $table->string('ig');
            $table->string('wa_admin');
            $table->string('wa_owner');
            $table->string('account');
            $table->string('account_name');
            $table->integer('transport_duration')->default(40);
            $table->integer('timeout')->default(30);
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
        Schema::dropIfExists('options');
    }
}
