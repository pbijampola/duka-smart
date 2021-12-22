<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','summary','description','stock','price','discount',
    'offer_price','photo','size','weight','status','condition','vendor_id','category_id',
    'child_cat_id','brand_id'];


    public function Brand(){
        return $this->belongsToMany(Brand::class);

    }
    public function Category(){
        return $this->belongsToMany(Category::class);
    }
}
