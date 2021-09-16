<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
            'user_id'       => 'required|integer',
            'license_id'  => 'required|integer',
            'placa'         => 'required|string|max:255',
            'brand_id'         => 'required|integer',
            'chasis'        => 'required|string|max:255',
            'modelo'        => 'required|string|max:255',
            'asientos'      => 'required|integer',
            'estado'        => 'required|string|max:255',
        ];
    }
}
