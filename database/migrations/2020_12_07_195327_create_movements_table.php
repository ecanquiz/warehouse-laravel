<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            //$table->id();
            $table->increments('id');
            $table->integer('type_id');
            $table->string('number', 10);
            $table->dateTime('date_time',0)->useCurrent();
            $table->string('subject', 40);
            $table->text('description');
            $table->text('observation');
            $table->date('close')->nullable();
            $table->integer('support_type_id');
            $table->string('support_number', 10);
            $table->dateTime('support_date',0);           
            $table->integer('user_insert_id')->default(1);
            $table->integer('user_update_id')->default(1);
            $table->integer('user_edit_id')->default(1);
            $table->boolean('editing')->default(false);
            //$table->uuid('store_uuid')->nullable()->default(null); // No more needed here
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
        Schema::dropIfExists('movements');
    }
}
