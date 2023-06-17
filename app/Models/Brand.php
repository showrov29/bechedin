<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $table='brands';
    public $timestamps=false;

    public function subBrand(){
        return $this->hasMany(SubBrands::class,'mainBrandId','id');
    }
    public function advertisement(){
        return $this->hasMany(Advertisement::class,'mainBrandId','id');
        
    }
    use HasFactory;
}
