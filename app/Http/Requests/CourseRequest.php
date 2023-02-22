<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
    if(request()->isMethod('POST')){
        $data = [
            'name' => 'required|unique:courses',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'demo' => 'nullable',
            'discount' => 'nullable',
            'description' => 'required',
            'price' => 'required'
        ];
        }elseif(request()->isMethod('PUT')){
        $data = [
            'name' => 'required','unique:courses,name'.$this->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'demo' => 'nullable',
            'discount' => 'nullable',
            'description' => 'required',
            'price' => 'required'
        ];
        }
    
        return $data;
    }
}
