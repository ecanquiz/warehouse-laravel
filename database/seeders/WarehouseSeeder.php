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
        
        DB::statement("INSERT INTO public.warehouses(uuid, name, description, created_at, updated_at) VALUES ('$uuid1','Almacén Uno', 'Almacén Uno, Almacén Uno, Almacén Uno', now(), now())");
        DB::statement("INSERT INTO public.warehouses(uuid, name, description, created_at, updated_at) VALUES ('$uuid2','Almacén Dos', 'Almacén Dos, Almacén Dos, Almacén Dos', now(), now())");
        DB::statement("INSERT INTO public.warehouses(uuid, name, description, created_at, updated_at) VALUES ('$uuid3','Almacén Tres', 'Almacén Tres, Almacén Tres,Almacén Tres', now(), now())");

    }
}




