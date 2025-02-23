<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewClosurePreInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
 CREATE VIEW public.view_closure_pre_insert AS
 SELECT a.date_time,
    a.article_warehouse_id,
        CASE
            WHEN (sum(b.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(b.sum)
        END AS quantity_input,
        CASE
            WHEN (sum(c.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(c.sum)
        END AS quantity_output,
        CASE
            WHEN (sum(d.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(d.sum)
        END AS quantity_reverse_input,
        CASE
            WHEN (sum(e.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(e.sum)
        END AS quantity_reverse_output
   FROM ((((public.view_clousure_mov_date_time_article_warehouse a
     LEFT JOIN public.view_closure_pre_insert_aux b ON (((a.article_warehouse_id = b.article_warehouse_id) AND (b.type_id = 1) AND (a.date_time = b.date_time))))
     LEFT JOIN public.view_closure_pre_insert_aux c ON (((a.article_warehouse_id = c.article_warehouse_id) AND (c.type_id = 2) AND (a.date_time = c.date_time))))
     LEFT JOIN public.view_closure_pre_insert_aux d ON (((a.article_warehouse_id = d.article_warehouse_id) AND (d.type_id = 3) AND (a.date_time = d.date_time))))
     LEFT JOIN public.view_closure_pre_insert_aux e ON (((a.article_warehouse_id = e.article_warehouse_id) AND (e.type_id = 4) AND (a.date_time = e.date_time))))
  GROUP BY a.date_time, a.article_warehouse_id
  ORDER BY a.date_time, a.article_warehouse_id;

ALTER TABLE public.view_closure_pre_insert
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
        DB::unprepared("DROP VIEW public.view_closure_pre_insert;");
    }
}
