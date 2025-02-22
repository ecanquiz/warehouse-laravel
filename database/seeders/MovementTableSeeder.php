<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ Movement, Warehouse };

//use Illuminate\Support\Facades\DB;

class MovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $stores = Warehouse::all();
        $storeUuid = $stores->first()->uuid;
        $faker = \Faker\Factory::create();
        $today = date("Y-m-d");        
        
        Movement::create([
            'type_id' => 1,
           // 'number' => '1',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 3 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 1,
            'support_number' => '000000000Z',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 3 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);

        Movement::create([
            'type_id' => 1,
            //'number' => '2',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 3 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),                        
            'support_type_id' => 1,
            'support_number' => '000000000Y',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 3 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);
        
        Movement::create([
            'type_id' => 2,
            //'number' => '3',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 3 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 4,
            'support_number' => '000000000X',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 3 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);
        
        //////////////////////////////////////////////////////////////////////

        Movement::create([
            'type_id' => 3,
           // 'number' => '4',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 2 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 1,
            'support_number' => '0000000002',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 2 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);
    
        Movement::create([
            'type_id' => 2,
            //'number' => '5',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 2 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 4,
            'support_number' => '000000000W',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 2 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);

        //////////////////////////////////////////////////////////////////////

        Movement::create([
            'type_id' => 4,
            // 'number' => '6',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 1 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 4,
            'support_number' => '000000000X',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 1 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);
        Movement::create([
            'type_id' => 2,
            //'number' => '7',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 1 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),                        
            'support_type_id' => 1,
            'support_number' => '000000000Y',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 1 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);
        
        Movement::create([
            'type_id' => 1,
            //'number' => '8',
            'date_time' => date("Y-m-d H:i:s", strtotime($today."- 1 days")),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 4,
            'support_number' => '000000000X',
            'support_date' => date("Y-m-d H:i:s", strtotime($today."- 1 days")),
            // 'store_uuid' => $storeUuid // No more needed here
        ]);

        Movement::create([
            'type_id' => 1,
            //'number' => '9',
            'date_time' => date("Y-m-d H:i:s", strtotime($today)),
            'subject' => $faker->name,
            'description' => $faker->text(10),
            'observation' => $faker->text(10),
            'support_type_id' => 4,
            'support_number' => '0000000XYZ',
            'support_date' => date("Y-m-d H:i:s", strtotime($today)),
            // 'store_uuid' => $subStores->last()->uuid // No more needed here
        ]);
    }
}
