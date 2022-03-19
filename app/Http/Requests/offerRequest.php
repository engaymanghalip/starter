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
            'name_ar' =>'required|max:100|unique:offers,name_ar',
            'name_en' =>'required|max:100|unique:offers,name_en',
            'price' =>'required|numeric',
            'details_ar'=>'required',
            'details_en'=>'required',
        ];
    }

    public function messages(){
        return  [
            'Offer Name' =>trans('messages.offer name'),
            'name_ar.required' =>trans('messages.offer name required'), // the -- shortcuts for the method trans
            'name_en.required' =>trans('messages.offer name required'),
            'name.max' => 'الحجم المدخل اكبر من الحجم المسموح',
            'name.unique' =>__('messages.offer name must be unique' ),
            'price.required' => __('messages.enter value to price' ),
            'price.numeric'=> __('messages.price number' ),
            'details_ar.required' => __('messages.enter value to details' ),
            'details_en.required' => __('messages.enter value to details' ),
        ];
}
}
