<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    function latestAdd(Request $request){
        return response()->json([1,2,3,4], 200);
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

        return response()->json(["message"=>'Addvertisement added Succsfully'], 200);
    }
}
