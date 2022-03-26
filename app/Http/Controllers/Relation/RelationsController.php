<?php

namespace App\Http\Controllers\Relation;

use  App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user = \App\User::with(['phone' => function($q){
            $q -> select('code','phone','user_id');
        }] )->find(4);
//        return $user -> phone-> phone;
        $user = \App\User::with('phone')->find(4);
//        return $user -> phone; //to get phone info just
        return response()->json($user);
    }

    public function hasOneRelationReverse(){
//       $phone = Phone::with('user') -> find(1);
        $phone = Phone::with(['user' => function($q){
            $q -> select('id','name');
        }])->find(1);
      //make some attribute visible
        $phone -> makeVisible(['user_id']);
//        $phone -> makeHidden(['code']);

//        return $phone -> user; //return user of this phone number
//        get all data phone + user
        return $phone;
    }

     public function getUserHasPhone(){
      return  User::whereHas('phone')->get();

     }

    public function getUserNotHasPhone(){
        return  User::whereDoesntHave('phone')->get();
    }
    public function getUserphonewithcondition(){
        return  User::whereHas('phone',function ($q){
            $q -> where('code','067');
        })->get();
    }

    ###### start one to muny functions ###############
      public function getHospitalDoctors(){
       $hospital = Hospital::find(1); // way 1
//          Hospital::where('id',1) -> first();  //way 2
//          Hospital::first(); //way 3
//        return $hospital -> doctorsRelation; // return hospital doctors

            $hospital = Hospital::with('doctorsRelation')-> find(1);

         $doctors = $hospital -> doctorsRelation;

//         foreach ($doctors as $doctor){
//             echo $doctor ->name.'<br>';
//         }

        $doctor = Doctor::find(4);
         return $doctor -> hospitalrelation -> name ;
      }

      public function hospitals(){
        $hospitals = Hospital::select('id','name','address')->get();
        return view('doctors.hospital',compact('hospitals'));
      }
      public function doctors($hospital_id){

       $hospital = Hospital::find($hospital_id);

          $doctors = $hospital -> doctorsRelation;

       return view('doctors.doctors',compact('doctors'));
      }
        // get all hospitals must have doctors
      public function hospitalsHasDoctor(){
         return $hospital = Hospital::whereHas('doctorsRelation')->get();
      }

      public function hospitalsHas_only_Female_Doctors(){
      return $hospital =  Hospital::with('doctorsRelation')->WhereHas('doctorsRelation', function($q){
            $q -> where('gender',1);
          })->get();
      }

   public function hospitalsHaveNotDoctors(){
      return $hospital = Hospital::whereDoesntHave('doctorsRelation')->get();
   }

   public function deleteHospital($hospital_id){
      $hospital = Hospital::find($hospital_id);

      if(!$hospital){
          return abort('404');
      }

        //delete doctors then delete the hospital
       // delete doctors in this hospital
       $hospital -> doctorsRelation() -> delete();

       //delete the hospital jus t with outr its children
       $hospital -> delete();

      //  return redirect()-> route('hospitals.all');
   }

    ###### end one to muny functions ###############


}
