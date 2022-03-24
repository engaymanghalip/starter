<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user = \App\User::with(['phone' => function($q){
            $q -> select('code','phone');
        }] )->find(4);
//        $user = \App\User::with('phone')->find(4);
//        return $user -> phone; //to get phone info just
        return response()->json($user);
    }
}
