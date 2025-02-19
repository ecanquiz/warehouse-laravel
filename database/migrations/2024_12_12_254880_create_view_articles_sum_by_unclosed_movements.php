<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewArticlesSumByUnclosedMovements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_articles_sum_by_unclosed_movements
 AS
 SELECT article_id,
    sum(inputs) AS inputs,
    sum(outputs) AS outputs,
    sum(reverse_inputs) AS reverse_inputs,
    sum(reverse_outputs) AS reverse_outputs,
    sum(total) AS total
   FROM ( SELECT view_stock_movement.article_id,
            view_stock_movement.inputs,
            view_stock_movement.outputs,
            view_stock_movement.reverse_inputs,
            view_stock_movement.reverse_outputs,
            view_stock_movement.total
           FROM view_stock_movement) alias
  GROUP BY article_id;

ALTER TABLE public.view_articles_sum_by_unclosed_movements
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
