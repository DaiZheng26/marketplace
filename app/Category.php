<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['category'];
    // protected $table = 'category';
 
    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

    // public function products()
    // {
    //     return $this->belongsTo('products','category');
    // }
}
