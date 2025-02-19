<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupportTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        DB::statement("INSERT INTO public.support_types(name, movement_type_id) VALUES ('ORDEN DE COMPRA', 1)");
        DB::statement("INSERT INTO public.support_types(name, movement_type_id) VALUES ('FACTURA', 2)");
    }
}
