<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsGenerateNumberTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION public.movements_generate_number()
                RETURNS trigger
                LANGUAGE 'plpgsql'
                COST 100
                VOLATILE NOT LEAKPROOF
            AS \$BODY\$
            BEGIN
                  NEW.number:=lpad(cast(NEW.id as character varying),10,'0');
                  return NEW;
                END;
            \$BODY\$;

            ALTER FUNCTION public.movements_generate_number()
                OWNER TO postgres;        
        ");
        
        DB::unprepared("                
            CREATE TRIGGER movement_generate_number
                BEFORE INSERT
                ON public.movements
                FOR EACH ROW
                EXECUTE PROCEDURE public.movements_generate_number();         
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("
            DROP TRIGGER movement_generate_number ON public.movements                      
        ");
        
        DB::unprepared("
            DROP FUNCTION public.movements_generate_number();            
        ");
    }
}
