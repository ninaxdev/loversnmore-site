<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->uuid('_uid')->unique();
            $table->string('key', 50);           // 'basic', 'plus', 'elite'
            $table->string('name', 100);
            $table->decimal('price', 8, 2);
            $table->string('interval', 10);      // 'month' or 'year'
            $table->string('stripe_price_id', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->index(['key', 'interval']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
