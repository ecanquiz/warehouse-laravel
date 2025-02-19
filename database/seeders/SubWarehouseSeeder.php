<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubWarehouseSeeder extends Seeder
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
        
        DB::statement("INSERT INTO public.sub_warehouses(uuid, name, description, created_at, updated_at) VALUES ('$uuid1','Sub Almacén Uno', 'Sub Almacén Uno Sub Almacén Uno Sub Almacén Uno', now(), now())");
        DB::statement("INSERT INTO public.sub_warehouses(uuid, name, description, created_at, updated_at) VALUES ('$uuid2','Sub Almacén Dos', 'Sub Almacén Dos Sub Almacén Dos Sub Almacén Dos', now(), now())");
        DB::statement("INSERT INTO public.sub_warehouses(uuid, name, description, created_at, updated_at) VALUES ('$uuid3','Sub Almacén Tres', 'Sub Almacén Tres Sub Almacén Tres Sub Almacén Tres', now(), now())");

    }
}




