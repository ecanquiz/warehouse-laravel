<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewExistenceDailyClosing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE VIEW public.view_existence_daily_closing AS
 SELECT a.article_id,
        CASE
            WHEN (a.quantity_input IS NULL) THEN 0
            ELSE a.quantity_input
        END AS entradas,
        CASE
            WHEN (a.quantity_output IS NULL) THEN 0
            ELSE a.quantity_output
        END AS salidas,
        CASE
            WHEN (a.quantity_reverse_input IS NULL) THEN 0
            ELSE a.quantity_reverse_input
        END AS reverso_entradas,
        CASE
            WHEN (a.quantity_reverse_output IS NULL) THEN 0
            ELSE a.quantity_reverse_output
        END AS reverso_salidas,
    ((COALESCE(a.quantity_input, 0) - COALESCE(a.quantity_reverse_input, 0)) - (COALESCE(a.quantity_output, 0) - COALESCE(a.quantity_reverse_output, 0))) AS total
   FROM public.close_days a
  WHERE true;

ALTER TABLE public.view_existence_daily_closing
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
        DB::unprepared("DROP VIEW public.view_existence_daily_closing;");
    }
}
