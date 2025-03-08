<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        $uuid1=(string)Str::uuid();
        $uuid2=(string)Str::uuid();
        $uuid3=(string)Str::uuid();
        
        DB::statement("INSERT INTO public.warehouses(uuid, name, description, categories, created_at, updated_at) VALUES ('$uuid1','Principal', 'Almacén Principal o Genetal', '[\"HERRAMIENTAS\", \"PINTURAS / EXTERIORES\", \"PINTURAS / INTERIORES\", \"PINTURAS / OTROS\", \"PRODUCTOS DE LIMPIEZA / ASEO PERSONAL\", \"PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR\"]', now(), now())");
        DB::statement("INSERT INTO public.warehouses(uuid, name, description, categories, created_at, updated_at) VALUES ('$uuid2','Productos de Limpieza', 'Almacén de Productos de Limpieza', '[\"PRODUCTOS DE LIMPIEZA / ASEO PERSONAL\", \"PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR\"]', now(), now())");
        DB::statement("INSERT INTO public.warehouses(uuid, name, description, categories, created_at, updated_at) VALUES ('$uuid3','Pinturas y Herramientas', 'Almacén de Pinturas y Herramientas', '[\"HERRAMIENTAS\", \"PINTURAS / EXTERIORES\", \"PINTURAS / INTERIORES\", \"PINTURAS / OTROS\"]', now(), now())");

    }
}




