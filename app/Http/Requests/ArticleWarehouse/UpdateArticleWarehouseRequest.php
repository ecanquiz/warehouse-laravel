<?php

namespace Modules\\Http\Requests\ArticleWarehouse;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleWarehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "article_id" => ["required"],  
            "warehouse_uuid" => ["required"],  
            "stock_min" => ["required"],  
            "stock_max" => ["required"],  
            "status" => ["required"],  
            "id_user_insert" => ["required"],  
            "id_user_update" => ["required"] 
            
        ];
    }
}
