<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionDailyClosingRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE FUNCTION public.daily_closing_register(i_date date, i_user_id integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
	INSERT INTO public.close_days(
		article_warehouse_id,
        accumulated,
		quantity_input, 
		quantity_output, 
		quantity_reverse_input, 
		quantity_reverse_output,
        created_at,
        updated_at,
		close, 
		id_user_insert		
	) SELECT 
	    view_closure_pre_insert.article_warehouse_id,
        COALESCE(view_total_article_warehouse_by_daily_closing.total, 0::numeric),
		quantity_input, 
		quantity_output,
		quantity_reverse_input, 
		quantity_reverse_output,
        now(),
        now(),
		i_date, 
		i_user_id        
		FROM view_closure_pre_insert
		  LEFT JOIN view_total_article_warehouse_by_daily_closing
		    ON view_closure_pre_insert.article_warehouse_id = view_total_article_warehouse_by_daily_closing.article_warehouse_id
		WHERE date_time::date = i_date;		
		
	UPDATE public.movements SET close = now()
		WHERE date_time::date = i_date;
		
	UPDATE public.movement_details SET close = now()
		WHERE movement_id IN (SELECT id FROM public.movements WHERE date_time::date = i_date);
		
	RETURN true;
END;
$$;

ALTER FUNCTION public.daily_closing_register(date, integer) OWNER TO postgres;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION public.daily_closing_register;");
    }
}
