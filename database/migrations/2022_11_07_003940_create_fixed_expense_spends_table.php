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
        Schema::create('fixed_expense_spends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixed_expense_cycle_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('description');
            $table->decimal('amount');
            $table->foreignId('tag_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('fixed_expense_spends');
    }
};
