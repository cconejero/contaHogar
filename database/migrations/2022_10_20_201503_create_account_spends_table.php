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
        Schema::create('account_spends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->cascadeOnDelete();
            $table->string('description');
            $table->decimal('amount', 8, 2);
            $table->foreignId('movement_id');
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
        Schema::dropIfExists('account_spends');
    }
};
