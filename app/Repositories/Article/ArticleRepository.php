<?php
namespace App\Repositories\Article;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository
{
   /**
   * Add foreign fields of articles info.  
   *
   * @return Array
   */    
    static public function addForeignFields(LengthAwarePaginator | Collection | Array $rows = []): LengthAwarePaginator | Collection | Array
    {
        foreach ($rows as $key => $value) {
            $article = DB::connection('pgsql_article')->table('articles')->find($value["article_id"]);
            $rows[$key]['int_cod'] = $article->int_cod;
            $rows[$key]['name'] = $article->name;
            $rows[$key]['description'] = $article->description;
        }

        return $rows;
    }    
}
