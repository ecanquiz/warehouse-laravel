<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewArticleWarehouseQuantityOutput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_article_warehouse_quantity_output
 AS
 SELECT a.article_warehouse_id,
    sum(a.quantity) AS quantity
   FROM movement_details a
     JOIN movements b ON a.movement_id = b.id AND b.close IS NULL
  WHERE b.type_id = 2
  GROUP BY a.article_warehouse_id;

ALTER TABLE public.view_article_warehouse_quantity_output
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
        DB::unprepared("DROP VIEW public.view_article_warehouse_quantity_output;");        
    }
}
