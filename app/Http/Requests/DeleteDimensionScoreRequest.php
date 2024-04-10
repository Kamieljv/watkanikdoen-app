<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDimensionScoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entity_class' => 'required|string',
            'entity_id' => 'required|integer',
            'dimension_id' => 'required|integer|exists:dimensions,id',
        ];
    }
}