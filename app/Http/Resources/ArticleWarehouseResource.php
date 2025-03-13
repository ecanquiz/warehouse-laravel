<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleWarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'article_id' => $this->article_id,
            'warehouse_uuid' => $this->warehouse_uuid,
            'stock_min' => $this->stock_min,
            'stock_max' => $this->stock_max,
            'status' => $this->status,
            //'id_user_insert' => $this->id_user_insert,
            //'id_user_update' => $this->id_user_update,
            
        ];
    }
}
