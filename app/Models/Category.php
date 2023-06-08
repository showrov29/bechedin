<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    public $timestamps=false;
    public function subCategory(){
        return $this->hasMany(subCategory::class,'mainCategoryId','id');
    }
}
