<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\SubBrands;
use Illuminate\Http\Request;
use Mockery\Expectation;
use Throwable;

class BrandController extends Controller
{
   function addBrandName(Request $request){
    $request->validate([
        'name' =>['required']
    ]);
    try{
        $newBrand= new Brand();
        $newBrand->name=$request->name;

        $newBrand->save();

        return response()->json(["message"=>"Brand Name Added Successfully","success"=>true],200);

    }
    catch(Expectation $e){
        return response()->json(["message"=>"Name already exists","success"=>false],500);
        
    }
    
   }


   function allBrandName(){
      
    
    try{
    
            $brands=Brand::with('subBrand')->get();
           
       return response()->json($brands,200);

    }
    catch(Throwable $e){
        return response()->json(["message"=>"Something went wrong"],500);

    }
    
   }



   function editBrandName(Request $request,int $id){
    $request->validate([
        'name' =>['required']
    ]);

    try{
    Brand::find($id)->update(['name' =>$request->name]);
    return response()->json(["message"=>"Name updated successfully"],200);
    
    }
    catch(Expectation $e){
        return response()->json(["message"=>"Update Failed",500]);
    }


    }
    

   function deleteBrandName(int $id){
    try{
        Brand::find($id)->delete();

        return response()->json(["message"=>"Deleted Successfully"],200);    
    }
    catch(Expectation $e){

        return response()->json(["message"=>"Delete Failed",500]);
    }

   }


   
   function allSubBrandName(){

    try{

       $subBrands= SubBrands::with('brand')->get();
       return response()->json([$subBrands],200);
    }
    catch(Expectation $e){

        return response()->json(["message"=>"Something went wrong"],200);
    }
    }

   function addSubBrandName(Request $request){
   
    $request->validate([
        'name' =>['required'],
        'mainBrandId' =>['required']
    ]);

  try{
    $newSubbrand=new SubBrands();
    $newSubbrand->name=$request->name;
    $newSubbrand->mainBrandId=$request->mainBrandId;

    $newSubbrand->save();
    return response("Name added successfully",200);
  }
  catch(Expectation $e){
    return response()->json(["message"=>"Name is not added"],500);
  }

   }
 
   function editSubBrandName(Request $request,int $id){
    $request->validate([
        'name' =>['required'],
        'brandId' =>['required']
    ]);
    

    try{

        SubBrands::find($id)->update(['name'=>$request->name]);
        return response()->json(["message"=>"Update Successfull"],200);
    }
    catch(Expectation $e){

        return response()->json(["message"=>"Update failed"],500);
    }

    }

   function deleteSubBrandName(int $id){

    try{
        SubBrands::find($id)->delete();
        return response()->json(["message"=>"Deleted Successfully"],200);
    }
    catch(Expectation $e){
        return response()->json(["message"=>"Delete failed"],500);
        
    }
   }


}
