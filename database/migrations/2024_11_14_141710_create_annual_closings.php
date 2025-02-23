<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annual_closings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_article_warehouse');
            $table->integer('incoming_quantity');
            $table->integer('outgoing_quantity');
            $table->integer('incoming_quantity_reversed');
            $table->integer('outgoing_quantity_reversed');
            $table->integer('user_id')->default(1);
            $table->timestamp('close');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_closings');
    }
};
