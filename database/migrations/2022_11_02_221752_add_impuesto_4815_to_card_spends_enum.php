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
        Schema::table('card_spends', function (Blueprint $table) {
            $table->renameColumn('tax','taxtmp');
        });

        Schema::table('card_spends', function (Blueprint $table) {
            $table->enum('tax',['impuesto_sello','impuesto_pais','impuesto_4815'])->nullable();
        });

        $all=DB::table('card_spends')->get();

        foreach($all as $item)
        {
            DB::table('card_spends')->where('id',$item->id)->update(['tax'=>$item->taxtmp]);
        }

        Schema::table('card_spends', function (Blueprint $table) {
            $table->dropColumn('taxtmp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
