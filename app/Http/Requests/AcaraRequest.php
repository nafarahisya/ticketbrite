<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class AcaraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Session::get('nama_panitia'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_acara' => 'sometimes|required|min:3|max:191',
            'deskripsi' => 'sometimes|required|min:6|max:191',
            'kota' => 'sometimes|required|min:3|max:100',
            'lokasi' => 'sometimes|required|min:6|max:191',
            'kategori' => 'sometimes|required|min:3|max:50',
            'cp' => 'sometimes|required|min:6|max:20',
            'maksimal' => 'sometimes|required|min:1|max:11',
            'status' => 'sometimes|required|min:1|max:11',

        ];
    }
}
