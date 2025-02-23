<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_details', function (Blueprint $table) {
            //$table->id();
            $table->increments('id');
            //$table->integer('movement_id');
            $table->integer('movement_id')->nullable()->unsigned();
            $table->integer('article_warehouse_id');
            $table->integer('quantity')->default(1);
            $table->date('close')->nullable();
            $table->integer('user_insert_id')->default(1);
            $table->integer('user_update_id')->default(1);
            $table->unique(['movement_id', 'article_warehouse_id']);
            $table->foreign('movement_id')->references('id')->on('movements');
            //$table->softDeletes();
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
        //Schema::dropIfExists('movement_details');
        DB::unprepared("DROP TABLE public.movement_details CASCADE;");
    }
}
