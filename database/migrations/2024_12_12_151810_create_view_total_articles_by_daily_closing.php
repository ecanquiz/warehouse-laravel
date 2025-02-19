<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewTotalArticlesByDailyClosing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE VIEW public.view_total_articles_by_daily_closing
 AS
 SELECT article_id,
    sum(total) AS total
   FROM ( SELECT view_stock_close_day.article_id,
            view_stock_close_day.total
           FROM view_stock_close_day) alias
  GROUP BY article_id;

ALTER TABLE public.view_total_articles_by_daily_closing
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
        DB::unprepared("DROP VIEW public.view_total_articles_by_daily_closing;");
    }
}
