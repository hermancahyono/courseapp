<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowCaseRequest extends FormRequest
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
                'course_id' => 'required',
                'title' => 'required',
                'cover' => 'required|mimes:png,jpg,jpeg|max:2048',
                'description' => 'required',

            ];
        } elseif (request()->isMethod('PUT')) {
            $data = [
                'course_id' => 'required',
                'title' => 'required',
                'cover' => 'mimes:png,jpg,jpeg|max:2048',
                'description' => 'required',
            ];
        }

        return $data;
    }
}
