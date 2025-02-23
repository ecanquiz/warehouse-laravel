<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ArticleWarehouse;

class ArticleWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        ArticleWarehouse::factory()
                ->count(10)
                ->sequence(
                    ['article_id' => 1],
                    ['article_id' => 2],
                    ['article_id' => 3],
                    ['article_id' => 4],
                    ['article_id' => 5],
                    ['article_id' => 6],
                    ['article_id' => 7],
                    ['article_id' => 8],
                    ['article_id' => 9],
                    ['article_id' => 10]
                )
                ->create();
    }
}

