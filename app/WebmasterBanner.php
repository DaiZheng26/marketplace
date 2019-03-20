<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebmasterBanner extends Model
{
    //
    public function banners()
    {

        return $this->hasMany('App\Banner', 'section_id');
    }
}
