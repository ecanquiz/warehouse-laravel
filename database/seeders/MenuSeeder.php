<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
         Menu::create([ // id 1
            "title" => "Dashboard",
            "menu_id" => null,
            "path" => "dashboard",
            "icon" => "dashboard.svg",
            "sort" => 1
        ]);

        Menu::create([ // id 2
            "title" => "Movimientos",
            "menu_id" => null,
            "path" => "#",
            "icon" => "printer",
            "sort" => 2
        ]);

        Menu::create([ // id 3
            "title" => "Entradas",
            "menu_id" => 2,
            "path" => "inputs",
            "icon" => "inputs.svg",
            "sort" => 1
        ]);

        Menu::create([ // id 4
            "title" => "Salidas",
            "menu_id" => 2,
            "path" => "outputs",
            "icon" => "outputs.svg",
            "sort" => 2
        ]);
        
        Menu::create([ // id 5
            "title" => "Reversos de Entrada",
            "menu_id" => 2,
            "path" => "input-reverses",
            "icon" => "input-reverses.svg",
            "sort" => 3
        ]);

        Menu::create([ // id 6
            "title" => "Reversos de Salida",
            "menu_id" => 2,
            "path" => "output-reverses",
            "icon" => "output-reverses.svg",
            "sort" => 4
        ]);

        Menu::create([ // id 7
            "title" => "Inventario",
            "menu_id" => null,
            "path" => "#",
            "icon" => "printer",
            "sort" => 3
        ]);

        Menu::create([ // id 8
            "title" => "Cierres Diarios",
            "menu_id" => 7,
            "path" => "daily-closings",
            "icon" => "movements.svg",
            "sort" => 1
        ]);

        Menu::create([ // id 9
            "title" => "Stock",
            "menu_id" => 7,
            "path" => "summary",
            "icon" => "summary.svg",
            "sort" => 2
        ]);

        Menu::create([ // id 10
            "title" => "Historial",
            "menu_id" => 7,
            "path" => "movements",
            "icon" => "history.svg",
            "sort" => 1
        ]);

        Menu::create([ // id 11
            "title" => "Admin",
            "menu_id" => null,
            "path" => "#",
            "icon" => "printer",
            "sort" => 4
        ]);

        Menu::create([ // id 12
            "title" => "Almacenes",
            "menu_id" => 11,
            "path" => "sub_warehouses",
            "icon" => "menus.svg",
            "sort" => 1
        ]);
        
        Menu::create([ // id 13
            "title" => "Artículos",
            "menu_id" => 11,
            "path" => "articles",
            "icon" => "articles.svg",
            "sort" => 2
        ]);        
        
        Menu::create([ // id 14
            "title" => "Usuarios",
            "menu_id" => 11,
            "path" => "users",
            "icon" => "user.svg",
            "sort" => 7
        ]);

        Menu::create([ // id 15
            "title" => "Roles",
            "menu_id" => 11,
            "path" => "roles",
            "icon" => "users.svg",
            "sort" => 6
        ]);

        Menu::create([ // id 16
            "title" => "Menus",
            "menu_id" => 11,
            "path" => "menus",
            "icon" => "menus.svg",
            "sort" => 1
        ]);

    }
}

