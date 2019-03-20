<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticsVisitor extends Model
{
    //Relation to AnalyticsPage
    public function vPages()
    {

        return $this->hasMany('App\AnalyticsPage',"visitor_id");
    }
}
