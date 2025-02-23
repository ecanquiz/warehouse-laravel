<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewClosurePreInsertAux extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE VIEW public.view_closure_pre_insert_aux AS 
   SELECT b.date_time,
    a.article_warehouse_id,
    sum(a.quantity) AS sum,
    b.type_id
   FROM (public.movement_details a
     JOIN public.movements b ON ((a.movement_id = b.id)))
  WHERE ((a.close IS NULL) AND (b.close IS NULL))
  GROUP BY b.date_time, a.article_warehouse_id, b.type_id
  ORDER BY b.date_time, a.article_warehouse_id, b.type_id;

ALTER TABLE public.view_closure_pre_insert_aux
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
        DB::unprepared("DROP VIEW public.view_closure_pre_insert_aux;");
    }
}
