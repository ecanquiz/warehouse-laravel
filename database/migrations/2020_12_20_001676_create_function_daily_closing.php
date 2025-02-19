<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionDailyClosing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE FUNCTION public.daily_closing(i_date_from date, i_date_to date, i_user_id integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
        o_return boolean;
        v_date date;        
BEGIN
	o_return:=false;
        IF (SELECT public.daily_closing_valid_dates(i_date_from, i_date_to)) THEN
		v_date = i_date_from;
		WHILE v_date <= i_date_to LOOP
			IF  (SELECT public.daily_closing_date_exists(v_date)) THEN
			        SELECT public.daily_closing_register(v_date, i_user_id) INTO o_return;				
			END IF;
			SELECT ( v_date + interval '1 day') INTO v_date; 
		END LOOP;
	END IF;  
	
	RETURN o_return;
	
END;
$$;

ALTER FUNCTION public.daily_closing(date, date, integer) OWNER TO postgres;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION public.daily_closing;");
    }
}
