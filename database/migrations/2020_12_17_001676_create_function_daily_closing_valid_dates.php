<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionDailyClosingValidDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE OR REPLACE FUNCTION public.daily_closing_valid_dates(i_date_from date, i_date_to date) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
        RETURN (i_date_from = (SELECT min(date_time::date) FROM public.movements WHERE close IS NULL)) 
               AND 
               (i_date_to <= now());
END;
$$;

ALTER FUNCTION public.daily_closing_valid_dates(date, date) OWNER TO postgres;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION public.daily_closing_valid_dates;");
    }
}
