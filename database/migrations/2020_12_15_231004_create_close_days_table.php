<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloseDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_days', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id');
            $table->integer('accumulated')->default(0);
            $table->integer('quantity_input')->default(0);
            $table->integer('quantity_output')->default(0);
            $table->integer('quantity_reverse_input')->default(0);
            $table->integer('quantity_reverse_output')->default(0);            
            $table->date('close')->useCurrent();
            $table->integer('id_user_insert')->default(1);
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
        Schema::dropIfExists('close_days');
    }
}
