<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Expectation;
use PhpParser\Node\Expr\Cast\String_;
use Psy\Readline\Hoa\Console;

class AdvertisementController extends Controller
{
    function latestAdd(Request $request){
        $addvertisements= Advertisement::paginate(2);
        return response()->json($addvertisements, 200);
    }

    function addAdvertisement(Request $request){
        $request->validate([
            'productName' =>['required'],
            'price' =>['required','number'],
            'description' =>['required'],
            'profileImage' =>['required','mimes:jpg,jpeg,png','max:1000'],
            'desImage1' =>['mimes:jpg,jpeg,png','max:1000'],
            'desImage2' =>['mimes:jpg,jpeg,png','max:1000'],
            'desImage3' =>['mimes:jpg,jpeg,png','max:1000'],
            'userId' =>['required','number'],
            'brandId' =>['required','number'],
            'categoryId' =>['required','number']

        ]);

        try{
            
           $newAdd=new Advertisement();
           $newAdd->save();
           return response()->json(["message"=>"Advertisemet added successfully","success"=>true]);
        }
        catch(Expectation $e){

            return response()->json(["message"=>'Advertisement Could not be added',"success"=>false], 200);
        }

    }

    function updateAdd(Request $request,int $id){

        $request->validate([
            'productName' =>['required'],
            'price' =>['required','number'],
            'description' =>['required'],
            'profileImage' =>['required','mimes:jpg,jpeg,png','max:1000'],
            'desImage1' =>['mimes:jpg,jpeg,png','max:1000'],
            'desImage2' =>['mimes:jpg,jpeg,png','max:1000'],
            'desImage3' =>['mimes:jpg,jpeg,png','max:1000'],
            'userId' =>['required','number'],
            'brandId' =>['required','number'],
            'categoryId' =>['required','number']

        ]);

        try{

            Advertisement::find($id)->update($request);
            return response()->json(["message"=>"Update Successful","success"=>true],200);

        }
        catch(Expectation $e){
            return response()->json(["message"=>"Update failed","success"=>false],500);
        }

   
    }

    function delete(int $id){
        try{
            Advertisement::find($id)->delete();
        }
        catch(Expectation $e){
            return response()->json(["message"=>"Delete Failed","success"=>false],500);
        }
    }
    function approve(int $id){
        try{
            Advertisement::find($id)->update(['status'=>true]);
        }
        catch(Expectation $e){
            return response()->json(["message"=>"Delete Failed","success"=>false],500);
        }
    }

    function details(int $id){
        try{
           $addvertisement= Advertisement::where('status','=',true)->with('user','subCategory','subBrand','Brand','Category')->find($id);

           return response()->json($addvertisement,200);
        }
        catch(Expectation $e){
            return response()->json(["message"=>"Something went wrong","success"=>false],500);
        }
    }
  
    function filter(Request $request){
        try{
          

            
            // $brands=collect($request->brandId); 
            // dd($brands);
            $results=Advertisement::where('status','=',true)->with('user','Brand','Category','subBrand','subCategory')
            ->whereIn('mainBrandId',$request->mainBrandId)
            ->whereIn('mainCategoryId',$request->mainCategoryId)
            ->whereIn('subCategoryId',$request->subCategoryId)
            ->whereIn('subBrandId',$request->subBrandId)
            ->whereBetween('price',[$request->minPrice,$request->maxPrice])
            ->paginate(15);
            // $results=Advertisement::all();
           return response()->json($results,200);
        }
        catch(Expectation $e){
            return response()->json(["message"=>"Something went wrong","success"=>false],500);
        }
    }
    
    
}
