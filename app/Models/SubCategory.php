<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $table='subCategories';
    public $timestamps=false;
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'mainCategoryId','id');
        
    }
    public function advertisement(){
        return $this->hasMany(Advertisement::class,'subCategoryId','id');
        
    }
}
