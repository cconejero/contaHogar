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
        Schema::create('card_spends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->cascadeOnDelete();
            $table->string('description');
            $table->decimal('amount', 8, 2);
            $table->foreignId('currency_id');
            $table->boolean('fixed')->default(false);
            $table->unsignedSmallInteger('actual_due');
            $table->unsignedSmallInteger('total_due');
            $table->unsignedSmallInteger('month');
            $table->unsignedSmallInteger('year');
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
        Schema::dropIfExists('card_spends');
    }
};
