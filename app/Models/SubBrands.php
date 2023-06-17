<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubBrands extends Model
{
    public $table='subBrands';
    public $timestamps=false;

    public function brand():BelongsTo{
       return $this->belongsTo(Brand::class,'mainBrandId','id');
        
    }
   

    public function advertisement(){
        return $this->hasMany(Advertisement::class,'subBrandId','id');
        
    }
    use HasFactory;
}
