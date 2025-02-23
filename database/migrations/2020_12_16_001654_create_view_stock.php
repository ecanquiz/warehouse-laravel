<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_stocks
 AS
 SELECT alias.article_warehouse_id,
    sum(alias.inputs) AS inputs,
    sum(alias.outputs) AS outputs,
    sum(alias.reverse_inputs) AS reverse_inputs,
    sum(alias.reverse_outputs) AS reverse_outputs,
    sum(alias.total) AS total
   FROM ( SELECT view_stock_movement.article_warehouse_id,
            view_stock_movement.inputs,
            view_stock_movement.outputs,
            view_stock_movement.reverse_inputs,
            view_stock_movement.reverse_outputs,
            view_stock_movement.total
           FROM view_stock_movement
        UNION ALL
         SELECT view_stock_close_day.article_warehouse_id,
            view_stock_close_day.inputs,
            view_stock_close_day.outputs,
            view_stock_close_day.reverse_inputs,
            view_stock_close_day.reverse_outputs,
            view_stock_close_day.total
           FROM view_stock_close_day) alias
  GROUP BY alias.article_warehouse_id;

ALTER TABLE public.view_stocks
    OWNER TO postgres;   
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP VIEW public.view_stocks;");
    }
}
