<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewClousureMovDateTimeArticleWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
 CREATE VIEW public.view_clousure_mov_date_time_article_warehouse AS
 SELECT DISTINCT b.date_time,
    a.article_warehouse_id
   FROM (public.movement_details a
     LEFT JOIN public.movements b ON ((a.movement_id = b.id)))
  WHERE ((a.close IS NULL) AND (b.close IS NULL))
  ORDER BY b.date_time, a.article_warehouse_id;

ALTER TABLE public.view_clousure_mov_date_time_article_warehouse
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
        DB::unprepared("DROP VIEW public.view_clousure_mov_date_time_article_warehouse;");
    }
}
