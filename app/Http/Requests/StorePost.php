<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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

    public function attributes()
    {
        return [
            'content' => 'contenu',
            'visibility_id' => 'visibilité'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => ['max:255'],
            'visibility_id' => ['required'],
            'media' => ['mimes:jpeg,bmp,png,gif,pdf,doc,docx,xlsx']
        ];
    }
}
