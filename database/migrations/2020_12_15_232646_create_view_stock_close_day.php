<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewStockCloseDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_stock_close_day
 AS
 SELECT a.article_warehouse_id,
        CASE
            WHEN a.quantity_input IS NULL THEN 0
            ELSE a.quantity_input
        END AS inputs,
        CASE
            WHEN a.quantity_output IS NULL THEN 0
            ELSE a.quantity_output
        END AS outputs,
        CASE
            WHEN a.quantity_reverse_input IS NULL THEN 0
            ELSE a.quantity_reverse_input
        END AS reverse_inputs,
        CASE
            WHEN a.quantity_reverse_output IS NULL THEN 0
            ELSE a.quantity_reverse_output
        END AS reverse_outputs,
    COALESCE(a.quantity_input, 0) - COALESCE(a.quantity_reverse_input, 0) - (COALESCE(a.quantity_output, 0) - COALESCE(a.quantity_reverse_output, 0)) AS total
   FROM ( SELECT close_days.id,
            close_days.article_warehouse_id,
            close_days.quantity_input,
            close_days.quantity_output,
            close_days.quantity_reverse_input,
            close_days.quantity_reverse_output,
            close_days.close--,
            --close_days.id_user_insert,
            --close_days.created_at,
            --close_days.updated_at
           FROM close_days) a
  WHERE true;

ALTER TABLE public.view_stock_close_day
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
        DB::unprepared("DROP VIEW public.view_stock_close_day CASCADE;");
    }
}
