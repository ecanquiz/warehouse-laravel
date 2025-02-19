<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovementDetail;


class MovementDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        MovementDetail::create([ 'movement_id' => 1, 'article_id' => 1, 'quantity' => 20 ]);
        MovementDetail::create([ 'movement_id' => 1, 'article_id' => 2, 'quantity' => 10 ]);
        MovementDetail::create([ 'movement_id' => 1, 'article_id' => 3, 'quantity' => 20 ]);

        MovementDetail::create([ 'movement_id' => 2, 'article_id' => 1, 'quantity' => 10 ]);
        MovementDetail::create([ 'movement_id' => 2, 'article_id' => 4, 'quantity' => 10 ]);

        MovementDetail::create([ 'movement_id' => 3, 'article_id' => 1, 'quantity' => 5  ]);
        MovementDetail::create([ 'movement_id' => 3, 'article_id' => 2, 'quantity' => 5  ]);

        ///////////////////////////////////////////////////////////////////////////////////

        MovementDetail::create([ 'movement_id' => 4, 'article_id' => 1, 'quantity' => 10 ]);
        MovementDetail::create([ 'movement_id' => 4, 'article_id' => 4, 'quantity' => 10 ]);

        MovementDetail::create([ 'movement_id' => 5, 'article_id' => 1, 'quantity' => 10  ]);
        MovementDetail::create([ 'movement_id' => 5, 'article_id' => 2, 'quantity' => 5  ]);

        ///////////////////////////////////////////////////////////////////////////////////

        MovementDetail::create([ 'movement_id' => 6, 'article_id' => 1, 'quantity' => 5  ]);
        MovementDetail::create([ 'movement_id' => 6, 'article_id' => 2, 'quantity' => 5  ]);

        MovementDetail::create([ 'movement_id' => 7, 'article_id' => 1, 'quantity' => 10  ]);
        MovementDetail::create([ 'movement_id' => 7, 'article_id' => 2, 'quantity' => 5   ]);

        MovementDetail::create([ 'movement_id' => 8, 'article_id' => 2, 'quantity' => 10 ]);
        MovementDetail::create([ 'movement_id' => 8, 'article_id' => 3, 'quantity' => 20 ]);
        MovementDetail::create([ 'movement_id' => 8, 'article_id' => 4, 'quantity' => 10 ]);

        // OTHER SUB-STORE ///////////////////////////////////////////////////////////////        

        MovementDetail::create([ 'movement_id' => 9, 'article_id' => 1, 'quantity' => 20 ]);
        MovementDetail::create([ 'movement_id' => 9, 'article_id' => 2, 'quantity' => 10 ]);
        MovementDetail::create([ 'movement_id' => 9, 'article_id' => 3, 'quantity' => 20 ]);
    }
}

