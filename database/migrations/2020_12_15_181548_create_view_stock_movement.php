<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewStockMovement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_stock_movement
 AS
 SELECT DISTINCT a.article_warehouse_id,
        CASE
            WHEN i.quantity IS NULL THEN 0::bigint
            ELSE i.quantity
        END AS inputs,
        CASE
            WHEN o.quantity IS NULL THEN 0::bigint
            ELSE o.quantity
        END AS outputs,
        CASE
            WHEN ri.quantity IS NULL THEN 0::bigint
            ELSE ri.quantity
        END AS reverse_inputs,
        CASE
            WHEN ro.quantity IS NULL THEN 0::bigint
            ELSE ro.quantity
        END AS reverse_outputs,
    COALESCE(i.quantity, 0::bigint) - COALESCE(ri.quantity, 0::bigint) - (COALESCE(o.quantity, 0::bigint) - COALESCE(ro.quantity, 0::bigint)) AS total
   FROM ( SELECT movement_details.id,
            --movement_details.movement_id,
            movement_details.article_warehouse_id,
            --movement_details.quantity,
            movement_details.close --,
            --movement_details.id_user_insert,
            --movement_details.id_user_update,
            --movement_details.created_at,
            --movement_details.updated_at
           FROM movement_details) a
     LEFT JOIN ( SELECT view_article_warehouse_quantity_input.article_warehouse_id,
            view_article_warehouse_quantity_input.quantity
           FROM view_article_warehouse_quantity_input) i ON a.article_warehouse_id = i.article_warehouse_id
     LEFT JOIN ( SELECT view_article_warehouse_quantity_output.article_warehouse_id,
            view_article_warehouse_quantity_output.quantity
           FROM view_article_warehouse_quantity_output) o ON a.article_warehouse_id = o.article_warehouse_id
     LEFT JOIN ( SELECT view_article_warehouse_quantity_reverse_input.article_warehouse_id,
            view_article_warehouse_quantity_reverse_input.quantity
           FROM view_article_warehouse_quantity_reverse_input) ri ON a.article_warehouse_id = ri.article_warehouse_id
     LEFT JOIN ( SELECT view_article_warehouse_quantity_reverse_output.article_warehouse_id,
            view_article_warehouse_quantity_reverse_output.quantity
           FROM view_article_warehouse_quantity_reverse_output) ro ON a.article_warehouse_id = ro.article_warehouse_id
  WHERE a.close IS NULL;

ALTER TABLE public.view_stock_movement
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
        DB::unprepared("DROP VIEW public.view_stock_movement CASCADE;");
    }
}
