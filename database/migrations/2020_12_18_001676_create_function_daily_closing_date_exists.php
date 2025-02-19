<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionDailyClosingDateExists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE FUNCTION public.daily_closing_date_exists(i_date date) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN

        RETURN (SELECT CASE WHEN count(*)=0 THEN false ELSE true END 
		FROM public.movements 
			WHERE close IS NULL AND date_time::date = i_date);

END;
$$;

ALTER FUNCTION public.daily_closing_date_exists(date) OWNER TO postgres;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION public.daily_closing_date_exists;");
    }
}
