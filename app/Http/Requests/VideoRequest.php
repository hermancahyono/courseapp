<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('POST')) {
            $data = [
                'name' => 'required',
                'episode' => 'required', 'unique:videos',
                'video_code' => 'required'
            ];
        } elseif (request()->isMethod('PUT')) {
            $data = [
                'name' => 'required',
                'episode' => 'required', 'unique:videos,episode' . $this->id,
                'video_code' => 'required',
            ];
        }
        return $data;
    }
}
