<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ArticleWarehouse;
use App\Models\Warehouse;

class ArticleWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [	
                "article_id" => 1,
                "int_cod" => "0000000001",
                "name" => "CUÑETE DE PINTURA PARA EXTERIORES BLANCO TRÁFICO.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 2,
                "int_cod" => "0000000002",
                "name" => "GALÓN DE PINTURA PARA EXTERIORES BLANCO TRÁFICO.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 3,
                "int_cod" => "0000000003",
                "name" => "MEDIO GALÓN DE PINTURA PARA EXTERIORES BLANCO TRÁFICO.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1",
            ], [
                "article_id" => 4,
                "int_cod" => "0000000004",
                "name" => "CUARTO DE GALÓN DE PINTURA PARA EXTERIORE BLANCO TRÁFICO.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 5,
                "int_cod" => "0000000005",
                "name" => "CUÑETE DE PINTURA PA EXTERIORES BLANCO TRÁFICO MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MONTANA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 6,
                "int_cod" => "0000000006",
                "name" => "GALÓN DE PINTURA PARA EXTERIORES BLANCO TRÁFICO MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MONTANA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 7,
                "int_cod" => "0000000007",
                "name" => "MEDIO GALÓN DE PINTURA PARA EXTERIORES BLANCO TRÁFICO MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MONTANA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 8,
                "int_cod" => "0000000008",
                "name" => "CUARTO DE GALÓN PINTURA PARA EXTERIORES BLANCO TRÁFICO MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MONTANA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 9,
                "int_cod" => "0000000009",
                "name" => "CUÑETE DE PINTURA PARA  EXTERIORES BLANCO TRÁFICO MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MANPICA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 10,
                "int_cod" => "0000000010",
                "name" => "GALÓN DE PINTURA PARA EXTERIORES BLANCO TRÁFICO MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MANPICA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 11,
                "int_cod" => "0000000011",
                "name" => "MEDIO GALÓN PINTURA PARA EXTERIORES BLANCO TRÁFICO MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MANPICA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 12,
                "int_cod" => "0000000012",
                "name" => "CUARTO DE GALÓN DE PINTURA PARA EXTERIORES BLANCO TRÁFICO MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / EXTERIORES, BLANCO TRÁFICO, MANPICA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 13,
                "int_cod" => "0000000013",
                "name" => "CUÑETE DE PINTURA PARA INTERIORES BLANCO OSTRA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 14,
                "int_cod" => "0000000014",
                "name" => "GALÓN DE PINTURA PARA INTERIORES BLANCO OSTRA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 15,
                "int_cod" => "0000000015",
                "name" => "GALÓN DE PINTURA PARA INTERIORES BLANCO OSTRA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 16,
                "int_cod" => "0000000016",
                "name" => "CUARTO DE GALÓN PINTURAS PARA INTERIORES BLANCO OSTRA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 17,
                "int_cod" => "0000000017",
                "name" => "CUÑETE DE PINTURA PARA INTERIORES BLANCO OSTRA MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MONTANA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 18,
                "int_cod" => "0000000018",
                "name" => "GALÓN DE PINTURA PARA INTERIORES BLANCO OSTRA MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MONTANA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 19,
                "int_cod" => "0000000019",
                "name" => "MEDIO GALÓN PINTURA PARA INTERIORES BLANCO OSTRA MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MONTANA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 20,
                "int_cod" => "0000000020",
                "name" => "GALÓN DE PINTURA PARA INTERIORES BLANCO OSTRA MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MONTANA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [	
                "article_id" => 21,
                "int_cod" => "0000000021",
                "name" => "CUÑETE DE PINTURA PARA INTERIORES BLANCO OSTRA MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MANPICA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [                
                "article_id" => 22,
                "int_cod" => "0000000022",
                "name" => "GALÓN DE PINTURA PARA INTERIORES BLANCO OSTRA MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MANPICA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 23,
                "int_cod" => "0000000023",
                "name" => "MEDIO GALÓN DE PINTURA PARA INTERIORES, BLANCO OSTRA MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MANPICA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 24,
                "int_cod" => "0000000024",
                "name" => "CUARTO DE GALÓN DE PINTURA PARA INTERIORES BLANCO OSTRA MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / INTERIORES, BLANCO OSTRA, MANPICA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 25,
                "int_cod" => "0000000025",
                "name" => "CUÑETE DE SELLADOR GRIS.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 26,
                "int_cod" => "0000000026",
                "name" => "GALÓN DE SELLADOR GRIS.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 27,
                "int_cod" => "0000000027",
                "name" => "MEDIO GALÓN DE SELLADOR GRIS.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 28,
                "int_cod" => "0000000028",
                "name" => "CUARTO DE GALÓN DE SELLADOR GRIS.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 29,
                "int_cod" => "0000000029",
                "name" => "CUÑETE DE SELLADOR GRIS MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MONTANA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 30,
                "int_cod" => "0000000030",
                "name" => "GALÓN DE SELLADOR GRIS MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MONTANA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 31,
                "int_cod" => "0000000031",
                "name" => "MEDIO GALÓN DE SELLADOR GRIS MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MONTANA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 32,
                "int_cod" => "0000000032",
                "name" => "CUARTO DE GALÓN DE SELLADOR GRIS MONTANA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MONTANA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 33,
                "int_cod" => "0000000033",
                "name" => "CUÑETE DE SELLADOR GRIS MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MANPICA, CUÑETE(S) DE 18.92 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 34,
                "int_cod" => "0000000034",
                "name" => "GALÓN DE SELLADOR GRIS MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MANPICA, GALÓN(ES) DE 3.78 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 35,
                "int_cod" => "0000000035",
                "name" => "MEDIO GALÓN DE SELLADOR GRIS MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MANPICA, GALÓN(ES) DE 1.89 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 36,
                "int_cod" => "0000000036",
                "name" => "CUARTO DE GALÓN DE SELLADOR GRIS MANPICA.",
                "photo" => "abc",
                "description" => "PINTURAS / OTROS, SELLADOR GRIS, MANPICA, GALÓN(ES) DE 0.94 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 37,
                "int_cod" => "0000000037",
                "name" => "PAQUETE DE JABON DE BARRA 110 GRAMOS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, JABON DE BARRA, PAQUETE(S) DE 110 Gramo(s), Cantidad: 1"
            ], [
                "article_id" => 38,
                "int_cod" => "0000000038",
                "name" => "PAQUETE DE JABON DE BARRA PROTEX 110 GRAMOS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, JABON DE BARRA, PROTEX, PAQUETE(S) DE 110 Gramo(s), Cantidad: 1"
            ], [
                "article_id" => 39,
                "int_cod" => "0000000039",
                "name" => "PAQUETE DE JABON DE BARRA REXONA 110 GRAMOS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, JABON DE BARRA, REXONA, PAQUETE(S) DE 110 Gramo(s), Cantidad: 1"                
            ], [
                "article_id" => 40,
                "int_cod" => "0000000040",
                "name" => "POTE DE DESODORANTE ROLLON 90 MILILITROS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, DESODORANTE ROLLON, POTE(S) DE 90 Mililitro(s), Cantidad: 1"
            ], [
                "article_id" => 41,
                "int_cod" => "0000000041",
                "name" => "POTE DE DESODORANTE ROLLON REXONA 90 MILILITROS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, DESODORANTE ROLLON, REXONA, POTE(S) DE 90 Mililitro(s), Cantidad: 1"
            ], [
                "article_id" => 42,
                "int_cod" => "0000000042",
                "name" => "POTE DE  DESODORANTE ROLLON EVERY NIGHT 90 MILILITROS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, DESODORANTE ROLLON, EVERY NIGHT, POTE(S) DE 90 Mililitro(s), Cantidad: 1"
            ], [
                "article_id" => 43,
                "int_cod" => "0000000043",
                "name" => "POTE DE SHAMPOO 200 MILILITROS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, SHAMPOO, POTE(S) DE 200 Mililitro(s), Cantidad: 1"
            ], [	
                "article_id" => 44,
                "int_cod" => "0000000044",
                "name" => "POTE DE  SHAMPOO EVERY NIGHT 200 MILILITROS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, SHAMPOO, EVERY NIGHT, POTE(S) DE 200 Mililitro(s), Cantidad: 1"
            ], [
                "article_id" => 45,
                "int_cod" => "0000000045",
                "name" => "POTE DE SHAMPOO PANTENE 200 MILILITROS.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / ASEO PERSONAL, SHAMPOO, PANTENE, POTE(S) DE 200 Mililitro(s), Cantidad: 1"
            ], [
                "article_id" => 46,
                "int_cod" => "0000000046",
                "name" => "FRASCO DE DETERGENTE LÍQUIDO 1 LITRO.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR, DETERGENTE LÍQUIDO, FRASCO(S) DE 1 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 47,
                "int_cod" => "0000000047",
                "name" => "FRASCO DE DETERGENTE LÍQUIDO LAVANSAN 1 LITRO.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR, DETERGENTE LÍQUIDO, LAVANSAN, FRASCO(S) DE 1 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 48,
                "int_cod" => "0000000048",
                "name" => "FRASCO DE  DETERGENTE LÍQUIDO LAS LLAVES 1 LITRO.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR, DETERGENTE LÍQUIDO, LAS LLAVES, FRASCO(S) DE 1 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 49,
                "int_cod" => "0000000049",
                "name" => "FRASCO DE DESINFECTANTE 1 LITRO.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR, DESINFECTANTE, FRASCO(S) DE 1 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 50,
                "int_cod" => "0000000050",
                "name" => "FRASCO DE DESINFECTANTE LAVANSAN 1 LITRO.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR, DESINFECTANTE, LAVANSAN, FRASCO(S) DE 1 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 51,
                "int_cod" => "0000000051",
                "name" => "FRASCO DE DESINFECTANTE LAS LLAVES 1 LITRO.",
                "photo" => "abc",
                "description" => "PRODUCTOS DE LIMPIEZA / HIGIENE DEL HOGAR, DESINFECTANTE, LAS LLAVES, FRASCO(S) DE 1 Litro(s), Cantidad: 1"
            ], [
                "article_id" => 52,
                "int_cod" => "0000000052",
                "name" => "ALICATE CHANNELLOCK.",
                "photo" => "abc",
                "description" => "HERRAMIENTAS, ALICATE, CHANNELLOCK, 1 Unidad(es), Cantidad: 1"
            ], [
                "article_id" => 53,
                "int_cod" => "0000000053",
                "name" => "ALICATE STANLEY.",
                "photo" => "abc",
                "description" => "HERRAMIENTAS, ALICATE, STANLEY, 1 Unidad(es), Cantidad: 1"
            ], [
                "article_id" => 54,
                "int_cod" => "0000000054",
                "name" => "ALICATE.",
                "photo" => "abc",
                "description" => "HERRAMIENTAS, ALICATE, 1 Unidad(es), Cantidad: 1"
            ], [	
                "article_id" => 55,
                "int_cod" => "0000000055",
                "name" => "DESTORNILLADOR GEDORE.",
                "photo" => "abc",
                "description" => "HERRAMIENTAS, DESTORNILLADOR, GEDORE, 1 Unidad(es), Cantidad: 1"
            ], [	
                "article_id" => 56,
                "int_cod" => "0000000056",
                "name" => "DESTORNILLADOR BOSCH.",
                "photo" => "abc",
                "description" => "HERRAMIENTAS, DESTORNILLADOR, BOSCH, 1 Unidad(es), Cantidad: 1"
            ], [
                "article_id" => 57,
                "int_cod" => "0000000057",
                "name" => "DESTORNILLADOR.",
                "photo" => "abc",
                "description" => "HERRAMIENTAS, DESTORNILLADOR, 1 Unidad(es), Cantidad: 1"
            ]
        ];       

        $warehouse = Warehouse::select("uuid", "code")->first();

        foreach ($data as $key => $value) {
            ArticleWarehouse::create([ 
                "article_id" => $value["article_id"],
                "warehouse_uuid" =>$warehouse->uuid,
                "warehouse_code" =>$warehouse->code,                
                "int_cod" => $value["int_cod"],
                "name" => $value["name"],
                "photo" => $value["photo"],
                "description" => $value["description"]
            ]);

        }
        
    }
}

