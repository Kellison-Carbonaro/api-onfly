<?php

namespace App\Http\Requests\Despesas;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDespesaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricao' => 'required|string|max:191',
            'data' => 'required|before_or_equal:now',
            'usuarios_id' => 'required',
            'valor' => [
                'required',
                'min:0'
            ]
        ];
    }
}
