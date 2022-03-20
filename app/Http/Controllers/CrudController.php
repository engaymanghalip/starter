<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{

    use OfferTrait;

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

    public function store(offerRequest $request){
       //validate value before sorting to database by using validator class

//        $rules = $this -> getRules();
//
//        $messages = $this -> getMessages();
//
//        $validator = Validator::make($request->all(),$rules,$messages);
//
//        if($validator -> fails()){
//            return redirect()->back()->withErrors($validator)->withInputs($request->all());
//        }

       //save immage
        $file_name = $this -> saveImage($request ->photo,'images/offers');

        //insert
        Offer::create([
//            'photo' =>  $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' =>  $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
       // return redirect()->back(); //to go back to main page when error is showen
//        return $request;
    }

//protected function getMessages(){
//        return $messages = [
//            'Offer Name' =>trans('messages.offer name'),
//            'name.required' =>trans('messages.offer name required'), // the -- shortcuts for the method trans
//            'name.max' => 'الحجم المدخل اكبر من الحجم المسموح',
//            'name.unique' =>__('messages.offer name must be unique' ),
//            'price.required' => __('messages.enter value to price' ),
//            'price.numeric'=> __('messages.price number' ),
//            'details.required' => __('messages.enter value to details' ),
//        ];
//}
//
//protected function getRules(){
//        return $rules = [
//            'name' =>'required|max:100|unique:offers,name',
//            'price' =>'required|numeric',
//            'details'=>'required|'
//        ];
//}

public function getAlloffers(){
       $offers = Offer::select('id',
           'price',
           'name_'.LaravelLocalization::getCurrentLocale().' as name',
       'details_'. LaravelLocalization::getCurrentLocale().' as details' )
           -> get();  //return collection

      return view('offers.all',compact('offers'));
}

public function editOffer($offer_id){
      //  Offer::findorFail($offer_id);
       $offer = offer::find($offer_id);  //search in given table id only

        if(!$offer){
            return  redirect() -> back() ;
        }

       $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($offer_id);

        return view('offers.edit',compact('offer'));


}

public function updateOffer(offerRequest $request,$offer_id){
        //validation
    // check if offer is exist
    $offer = Offer:: find($offer_id);
    if(!$offer){
        return  redirect() -> back() ;
    }

    //update
    $offer ->update($request -> all()); //way 1 to updaTE ALL

    return redirect()-> back() -> with(['success'=>'تم التحديث بنجاح']);
    // way 2 to update اعمدة محددة
//    $offer ->update([
//       'name_ar'=> $request -> name_ar,
//        'name_en'=> $request -> name_en,
//        'price'=> $request -> price,
//        ]);
}

public function delete($offer_idDelete){
        //check if offer id is exists
    $offer = Offer:: find($offer_idDelete);
    if(!$offer){
        return  redirect() -> back() -> with(['error'=>__('messages.offer is not exist')]);
    }
    $offer -> delete();
return redirect()
    ->route('offers.all')
    ->with(['success'=>__('messages.offer deleted successuly')]);
}
public function getVideo(){
     $video = Video::first();
     event(new VideoViewer($video)); // fire event
    return view('video')->with('video', $video);
}

}



















