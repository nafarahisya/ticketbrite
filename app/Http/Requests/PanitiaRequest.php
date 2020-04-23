<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class PanitiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Session::get('username');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_panitia' => 'sometimes|required|min:3|max:30|unique:panitia,nama_panitia',
            'foto' => 'sometimes|required',
            'alamat' => 'sometimes|required|min:6|max:90',
            'nohp' => 'sometimes|required|min:6|max:90',
        ];
    }
}
