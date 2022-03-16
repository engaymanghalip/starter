<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

    public function __construct()
    {

    }

    public function getoffers(){
        return Offer::select('id','name')->get();
    }

//    public function store(){
//        Offer::create([
//           'name' => 'offer3',
//            'price' => '8000',
//            'details' => 'offer detail;s sfjlaksjfk',
//        ]);
//    }

 public function create(){
        return view('offers.create');
 }

    public function store(Request $request){
       //validate value before sorting to database by using validator class

        $rules = $this -> getRules();

        $messages = $this -> getMessages();

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        //insert
        Offer::create([
            'name' => $request->name,
            'price' =>  $request->price,
            'details' => $request->details,
        ]);
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
       // return redirect()->back(); //to go back to main page when error is showen
//        return $request;
    }

protected function getMessages(){
        return $messages = [
            'Offer Name' =>trans('messages.offer name'),
            'name.required' =>trans('messages.offer name required'), // the -- shortcuts for the method trans
            'name.max' => 'الحجم المدخل اكبر من الحجم المسموح',
            'name.unique' =>__('messages.offer name must be unique' ),
            'price.required' => __('messages.enter value to price' ),
            'price.numeric'=> __('messages.price number' ),
            'details.required' => __('messages.enter value to details' ),
        ];
}

protected function getRules(){
        return $rules = [
            'name' =>'required|max:100|unique:offers,name',
            'price' =>'required|numeric',
            'details'=>'required|'
        ];
}

}
