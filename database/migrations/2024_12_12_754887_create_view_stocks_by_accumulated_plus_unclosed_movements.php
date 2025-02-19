<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewStocksByAccumulatedPlusUnclosedMovements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_stocks_by_accumulated_plus_unclosed_movements
 AS
 SELECT a.id,
    a.int_cod,
    a.name,
    COALESCE(b.total, 0::bigint) AS accumulated,
    COALESCE(c.inputs, 0::numeric) AS inputs,
    COALESCE(c.outputs, 0::numeric) AS outputs,
    COALESCE(c.reverse_inputs, 0::numeric) AS reverse_inputs,
    COALESCE(c.reverse_outputs, 0::numeric) AS reverse_outputs,
    COALESCE(b.total, 0::bigint)::numeric + (COALESCE(c.inputs, 0::numeric) - COALESCE(c.reverse_inputs, 0::numeric)) - (COALESCE(c.outputs, 0::numeric) - COALESCE(c.reverse_outputs, 0::numeric)) AS stock_current,
    a.stock_min,
    a.stock_max
   FROM articles a
     LEFT JOIN view_total_articles_by_daily_closing b ON b.article_id = a.id
     LEFT JOIN view_articles_sum_by_unclosed_movements c ON c.article_id = a.id
  ORDER BY a.id;

ALTER TABLE public.view_stocks_by_accumulated_plus_unclosed_movements
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
        DB::unprepared("DROP VIEW public.view_articles_sum_by_unclosed_movements;");
    }
}
