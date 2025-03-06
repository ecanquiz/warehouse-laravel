<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseGenerateCodeTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION public.warehouses_generate_code()
                RETURNS trigger
                LANGUAGE 'plpgsql'
                COST 100
                VOLATILE NOT LEAKPROOF
            AS \$BODY\$
            BEGIN
                  NEW.code:=lpad(cast(NEW.id as character varying),3,'0');
                  return NEW;
                END;
            \$BODY\$;

            ALTER FUNCTION public.warehouses_generate_code()
                OWNER TO postgres;        
        ");
        
        DB::unprepared("                
            CREATE TRIGGER warehouse_generate_code
                BEFORE INSERT
                ON public.warehouses
                FOR EACH ROW
                EXECUTE PROCEDURE public.warehouses_generate_code();         
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
            DROP TRIGGER warehouse_generate_code ON public.warehouses                      
        ");
        
        DB::unprepared("
            DROP FUNCTION public.warehouses_generate_code();   
        ");
    }
}
