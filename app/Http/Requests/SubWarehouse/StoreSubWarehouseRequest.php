<?php

namespace Modules\Store\Http\Requests\SubWarehouse;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubWarehouseRequest extends FormRequest
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
            // "uuid" => ["required"],  
            "name" => ["required"],  
            "description" => ["required"] 
            
        ];
    }
}
