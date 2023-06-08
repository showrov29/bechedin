<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Mockery\Expectation;

class CategoryController extends Controller
{
    function addCategory(Request $request){
        $request->validate([
            'name' =>['required']
        ]);

        try{
            $newBrand= new Category();
            $newBrand->name=$request->name;
    
            $newBrand->save();
    
            return response()->json(["message"=>"Category Added Successfully","success"=>true],200);
    
        }
        catch(Expectation $e){
            return response()->json(["message"=>"Category already exists","success"=>false],500);
            
        }
        
       }


       function allCategory(){
        try{
    
            $categories=Category::with('subCategory')->get();
           
       return response()->json($categories,200);

    }
    catch(Expectation $e){
        return response()->json(["message"=>"Something went wrong"],500);

    }
    
        
       }


       function editCategory(Request $request,int $id){
        $request->validate([
            'name' =>['required']
        ]);
    
        try{
        Category::find($id)->update(['name' =>$request->name]);
        return response()->json(["message"=>"Category updated successfully"],200);
        
        }
        catch(Expectation $e){
            return response()->json(["message"=>"Update Failed",500]);
        }
    
    
        }
        

       function deleteCategory(int $id){
    
        try{
            Category::find($id)->delete();
    
            return response()->json(["message"=>"Deleted Successfully"],200);    
        }
        catch(Expectation $e){
    
            return response()->json(["message"=>"Delete Failed",500]);
        }
    
        
       }
    

       function allSubCategory(){
        try{

            $subCategories= SubCategory::with('category')->get();
            return response()->json([$subCategories],200);
         }
         catch(Expectation $e){
     
             return response()->json(["message"=>"Something went wrong"],200);
         }
         
        }
       function addSubCategory(Request $request){
        $request->validate([
            'name' =>['required'],
            'categoryId' =>['required']
        ]);
        try{
            $newSubbrand=new SubCategory();
            $newSubbrand->name=$request->name;
            $newSubbrand->mainBrandId=$request->mainBrandId;
        
            $newSubbrand->save();
            return response("Category added successfully",200);
          }
          catch(Expectation $e){
            return response()->json(["message"=>"Category already exists"],500);
          }
        
       }


       function editSubCategory(Request $request,int $id){
        $request->validate([
            'name' =>['required'],
            'categoryId' =>['required']
        ]);

        try{

            SubCategory::find($id)->update(['name'=>$request->name]);
            return response()->json(["message"=>"Update Successfull"],200);
        }
        catch(Expectation $e){
    
            return response()->json(["message"=>"Update failed"],500);
        }
    
        }


    
       function deleteSubCategory(int $id){
    
        try{
        SubCategory::find($id)->delete();
        return response()->json(["message"=>"Deleted Successfully"],200);
    }
    catch(Expectation $e){
        return response()->json(["message"=>"Delete failed"],500);
        
    }
        
       }
}
