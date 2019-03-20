<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //Relation to webmasterSections
    public function webmasterSection()
    {

        return $this->belongsTo('App\WebmasterSection', 'webmaster_id');
    }

    //Relation to Sections
    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }

    //Relation to TopicCategory
    public function categories()
    {
        return $this->hasMany('App\TopicCategory');
    }

    //Relation to Users
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    //Relation to Photos
    public function photos()
    {

        return $this->hasMany('App\Photo', 'topic_id')->orderby('row_no', 'asc');
    }

    //Relation to Attach Files
    public function attachFiles()
    {

        return $this->hasMany('App\AttachFile', 'topic_id')->orderby('row_no', 'asc');
    }

    //Relation to Related Topics
    public function relatedTopics()
    {
        return $this->hasMany('App\RelatedTopic', 'topic_id')->orderby('row_no', 'asc');
    }

    //Relation to Maps
    public function maps()
    {

        return $this->hasMany('App\Map', 'topic_id')->orderby('row_no', 'asc');
    }


    //Relation to Comments
    public function comments()
    {

        return $this->hasMany('App\Comment', 'topic_id')->orderby('row_no', 'asc');
    }

    //Relation to New Comments
    public function newComments()
    {

        return $this->hasMany('App\Comment', 'topic_id')->where('status', '=', 0)->orderby('row_no', 'asc');
    }

    //Relation to approved Comments
    public function approvedComments()
    {
        return $this->hasMany('App\Comment', 'topic_id')->where('status', '=', 1)->orderby('row_no', 'asc');
    }

    //Relation to Additional Fields
    public function fields()
    {

        return $this->hasMany('App\TopicField', 'topic_id')->orderby('id', 'asc');
    }

}
