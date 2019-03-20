<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebmasterSectionField extends Model
{
    public function fields()
    {

        return $this->hasMany('App\TopicField' , 'field_id')->orderby('id', 'asc');
    }
}
