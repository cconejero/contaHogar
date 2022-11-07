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
        Schema::create('fixed_expense_cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixed_expense_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('year');
            $table->integer('month');
            $table->boolean('paid')->default(false);
            $table->date('due_date');
            $table->timestamps();

            $table->unique(['fixed_expense_id', 'year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixed_expense_cycles');
    }
};
