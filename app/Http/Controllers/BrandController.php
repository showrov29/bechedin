<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class BrandController extends Controller
{
   function addBrandName(Request $request){
    $request->validate([
        'name' =>['required']
    ]);
    
   }
   function allBrandName(){
   return  response()->json([1,2,45,], 200);
    
   }
   function editBrandName(Request $request,int $id){
    $request->validate([
        'name' =>['required']
    ]);
    }
    
   function deleteBrandName(int $id){

    
   }

   function allSubBrandName(){
    return  response()->json([1,2,45,], 200);
     
    }
   function addSubBrandName(Request $request){
    $request->validate([
        'name' =>['required'],
        'brandId' =>['required']
    ]);
    
   }
   function editSubBrandName(Request $request,int $id){
    $request->validate([
        'name' =>['required'],
        'brandId' =>['required']
    ]);
    }

   function deleteSubBrandName(int $id){

    
   }


}
