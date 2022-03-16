<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
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
            'name' =>'required|max:100|unique:offers,name',
            'price' =>'required|numeric',
            'details'=>'required|'
        ];
    }

    public function messages(){
        return  [
            'Offer Name' =>trans('messages.offer name'),
            'name.required' =>trans('messages.offer name required'), // the -- shortcuts for the method trans
            'name.max' => 'الحجم المدخل اكبر من الحجم المسموح',
            'name.unique' =>__('messages.offer name must be unique' ),
            'price.required' => __('messages.enter value to price' ),
            'price.numeric'=> __('messages.price number' ),
            'details.required' => __('messages.enter value to details' ),
        ];
}
}
