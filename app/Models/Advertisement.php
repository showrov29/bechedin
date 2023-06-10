<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public $table='advertisements';
    public $timestamps=false;

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'userId','id');
    }
    public function subBrand(){
        return $this->belongsTo(SubBrands::class,'brandId','id');
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'categoryId','id');
    }
}
