<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_warehouse', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id')->nullable()->unsigned();
            $table->uuid('warehouse_uuid')->nullable()->unsigned();
            $table->foreign('warehouse_uuid')->references('uuid')->on('warehouses');
            $table->unique(['warehouse_uuid', 'article_id']);       
            $table->string('int_cod', 15);
            $table->string('name',50);
            $table->float('price')->default(100);
            $table->integer('stock_min')->default(5);
            $table->integer('stock_max')->default(5);
            $table->integer('status')->default(1);
            $table->string('photo')->default('');
            $table->text('description')->default('');     
            $table->integer('id_user_insert')->default(1);
            $table->integer('id_user_update')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_warehouse');
    }
}
