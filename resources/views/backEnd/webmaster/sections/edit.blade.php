@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box m-b-0">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.sectionEdit') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    {{ trans('backLang.webmasterTools') }} /
                    <a href="">{{ trans('backLang.siteSectionsSettings') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("WebmasterSections")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <?php
        $tab_1 = "active";
        $tab_2 = "";
        $tab_3 = "";
        if (Session::has('activeTab')) {
            if (Session::get('activeTab') == "fields") {
                $tab_1 = "";
                $tab_2 = "active";
                $tab_3 = "";
            }
            if (Session::get('activeTab') == "seo") {
                $tab_1 = "";
                $tab_2 = "";
                $tab_3 = "active";
            }
        }
        ?>
        <div class="box nav-active-border b-info">
            <ul class="nav nav-md">
                <li class="nav-item inline">
                    <a class="nav-link {{ $tab_1 }}" href data-toggle="tab" data-target="#tab_details">
                        <span class="text-md"><i class="material-icons">
                                &#xe31e;</i> {{ trans('backLang.topicTabSection') }}</span>
                    </a>
                </li>
                <li class="nav-item inline">
                    <a class="nav-link  {{ $tab_2 }}" href data-toggle="tab" data-target="#tab_custom">
                    <span class="text-md"><i class="material-icons">
                            &#xe30d;</i> {{ trans('backLang.customFields') }}</span>
                    </a>
                </li>
                @if(Helper::GeneralWebmasterSettings("seo_status"))
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_3 }}" href data-toggle="tab" data-target="#tab_seo">
                    <span class="text-md"><i class="material-icons">
                            &#xe8e5;</i> {{ trans('backLang.seoTabTitle') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
            <div class="tab-content clear b-t">
                <div class="tab-pane  {{ $tab_1 }}" id="tab_details">
                    <div class="box-body">
                        {{Form::open(['route'=>['WebmasterSectionsUpdate',$WebmasterSections->id],'method'=>'POST'])}}

                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}</label>
                            <div class="col-sm-10">
                                {!! Form::text('name',$WebmasterSections->name, array('placeholder' => trans('backLang.langVar'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.sectionType') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('type','0',($WebmasterSections->type==0) ? true : false, array('id' => 'site_status1','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.typeTextPages') }}
                                        </label>
                                    </div>
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('type','1',($WebmasterSections->type==1) ? true : false, array('id' => 'site_status2','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.typePhotos') }}
                                        </label>
                                    </div>
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('type','2',($WebmasterSections->type==2) ? true : false, array('id' => 'site_status3','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.typeVideos') }}
                                        </label>
                                    </div>
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('type','3',($WebmasterSections->type==3) ? true : false, array('id' => 'site_status4','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.typeSounds') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sections_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.hasCategories') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('sections_status','0',($WebmasterSections->sections_status==0) ? true : false, array('id' => 'sections_status1','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.withoutCategories') }}
                                        </label>
                                    </div>
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('sections_status','1',($WebmasterSections->sections_status==1) ? true : false, array('id' => 'sections_status2','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.mainCategoriesOnly') }}
                                        </label>
                                    </div>
                                    <div style="margin-bottom: 5px;">
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('sections_status','2',($WebmasterSections->sections_status==2) ? true : false, array('id' => 'sections_status3','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ trans('backLang.mainAndSubCategories') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <br/>
                            <label><h5><i class="material-icons">&#xe1db;</i> {{ trans('backLang.optionalFields') }}
                                </h5></label>
                            <hr>
                        </div>

                        <div class="form-group row">
                            <label for="date_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.dateField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('date_status','1',($WebmasterSections->date_status==1) ? true : false, array('id' => 'date_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('date_status','0',($WebmasterSections->date_status==0) ? true : false, array('id' => 'date_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expire_date_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.expireDateField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('expire_date_status','1',($WebmasterSections->expire_date_status==1) ? true : false, array('id' => 'expire_date_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('expire_date_status','0',($WebmasterSections->expire_date_status==0) ? true : false, array('id' => 'expire_date_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="longtext_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.longTextField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('longtext_status','1',($WebmasterSections->longtext_status==1) ? true : false, array('id' => 'longtext_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('longtext_status','0',($WebmasterSections->longtext_status==0) ? true : false, array('id' => 'longtext_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editor_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.allowEditor') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('editor_status','1',($WebmasterSections->editor_status==1) ? true : false, array('id' => 'editor_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('editor_status','0',($WebmasterSections->editor_status==0) ? true : false, array('id' => 'editor_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="attach_file_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.attachFileField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('attach_file_status','1',($WebmasterSections->attach_file_status==1) ? true : false, array('id' => 'attach_file_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('attach_file_status','0',($WebmasterSections->attach_file_status==0) ? true : false, array('id' => 'attach_file_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="section_icon_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.sectionIconPicker') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('section_icon_status','1',($WebmasterSections->section_icon_status==1) ? true : false, array('id' => 'section_icon_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('section_icon_status','0',($WebmasterSections->section_icon_status==0) ? true : false, array('id' => 'section_icon_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="icon_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicsIconPicker') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('icon_status','1',($WebmasterSections->icon_status==1) ? true : false, array('id' => 'icon_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('icon_status','0',($WebmasterSections->icon_status==0) ? true : false, array('id' => 'icon_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <br/>
                            <label><h5><i class="material-icons">&#xe8d8;</i> {{ trans('backLang.additionalTabs') }}
                                </h5></label>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label for="multi_images_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.additionalImages') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('multi_images_status','1',($WebmasterSections->multi_images_status==1) ? true : false, array('id' => 'multi_images_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('multi_images_status','0',($WebmasterSections->multi_images_status==0) ? true : false, array('id' => 'multi_images_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extra_attach_file_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.additionalFiles') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('extra_attach_file_status','1',($WebmasterSections->extra_attach_file_status==1) ? true : false, array('id' => 'extra_attach_file_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('extra_attach_file_status','0',($WebmasterSections->extra_attach_file_status==0) ? true : false, array('id' => 'extra_attach_file_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="maps_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.attachGoogleMaps') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('maps_status','1',($WebmasterSections->maps_status==1) ? true : false, array('id' => 'maps_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('maps_status','0',($WebmasterSections->maps_status==0) ? true : false, array('id' => 'maps_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="order_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.attachOrderForm') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('order_status','1',($WebmasterSections->order_status==1) ? true : false, array('id' => 'order_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('order_status','0',($WebmasterSections->order_status==0) ? true : false, array('id' => 'order_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="comments_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.reviewsAvailable') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('comments_status','1',($WebmasterSections->comments_status==1) ? true : false, array('id' => 'comments_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('comments_status','0',($WebmasterSections->comments_status==0) ? true : false, array('id' => 'comments_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="related_status1"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.relatedTopics') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('related_status','1',($WebmasterSections->related_status==1) ? true : false, array('id' => 'related_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('related_status','0',($WebmasterSections->related_status==0) ? true : false, array('id' => 'related_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <br/>
                            <label><h5><i class="material-icons">&#xe8ac;</i> {{ trans('backLang.active_disable') }}
                                </h5></label>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label for="link_status"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','1',($WebmasterSections->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.active') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','0',($WebmasterSections->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.notActive') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-t-md">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                        &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                <a href="{{route("WebmasterSections")}}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>


                {{-- Custom Fields--}}

                <div class="tab-pane  {{ $tab_2 }}" id="tab_custom">

                    <div class="box-body">
                        @if (Session::has('fieldST'))
                            @if (Session::get('fieldST') == "create")

                                <div>
                                    {{Form::open(['route'=>['webmasterFieldsStore',$WebmasterSections->id],'method'=>'POST'])}}

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group row">
                                            <label for="file_title_ar"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('title_ar','', array('placeholder' => '','class' => 'form-control','id'=>'file_title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group row">
                                            <label for="file_title_en"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('title_en','', array('placeholder' => '','class' => 'form-control','id'=>'file_title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="type0"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.customFieldsType') !!}</label>
                                        <div class="col-sm-3">
                                            <div class="radio">
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','0',true, array('id' => 'type0','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType0') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','1',false, array('id' => 'type1','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType1') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','2',false, array('id' => 'type2','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType2') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','3',false, array('id' => 'type3','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType3') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','4',false, array('id' => 'type4','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType4') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','5',false, array('id' => 'type5','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType5') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','6',false, array('id' => 'type6','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType6') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','7',false, array('id' => 'type7','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType7') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','8',false, array('id' => 'type8','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType8') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','9',false, array('id' => 'type9','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType9') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','10',false, array('id' => 'type10','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType10') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','11',false, array('id' => 'type11','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType11') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','12',false, array('id' => 'type12','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType12') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="options" style="display: none">
                                            @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                                <div class="col-sm-3 col-xs-5">
                                                    <div>
                                                        {!!  trans('backLang.customFieldsOptions') !!}
                                                        @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                                        :
                                                    </div>
                                                    {!! Form::textarea('details_ar','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.rtl'),'rows'=>'12','style'=>'white-space: nowrap;')) !!}
                                                    <small>
                                                        <i class="material-icons">&#xe8fd;</i> {!!  trans('backLang.customFieldsOptionsHelp') !!}
                                                    </small>
                                                </div>
                                            @endif
                                            @if(Helper::GeneralWebmasterSettings("ar_box_status") || Helper::GeneralWebmasterSettings("en_box_status"))
                                                <div class="col-sm-1 col-xs-1 text-center"
                                                     style="width: 30px !important;padding: 0;">
                                                    <br>
                                                    <?php
                                                    $i2 = 0;
                                                    ?>
                                                    @for($i=1;$i<=12;$i++)
                                                        <?php
                                                        $i2++;
                                                        $bg_volor = "#f0f0f0";
                                                        if ($i2 == 2) {
                                                            $i2 = 0;
                                                            $bg_volor = "#f9f9f9";
                                                        }
                                                        ?>
                                                        <div style="font-size: 1rem;line-height: 1.62;background: {{$bg_volor}}">
                                                            <small>
                                                                <small>{{$i}}</small>
                                                            </small>
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endif
                                            @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                                <div class="col-sm-3 col-xs-5">
                                                    <div>
                                                        {!!  trans('backLang.customFieldsOptions') !!}
                                                        @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                                        :
                                                    </div>
                                                    {!! Form::textarea('details_en','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'rows'=>'12','style'=>'white-space: nowrap;')) !!}
                                                    <small>
                                                        <i class="material-icons">&#xe8fd;</i> {!!  trans('backLang.customFieldsOptionsHelp') !!}
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="required1"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.customFieldsRequired') !!}</label>
                                        <div class="col-sm-10">
                                            <div class="radio">
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('required','0',true, array('id' => 'required2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    {{ trans('backLang.customFieldsOptional') }}
                                                </label>
                                                &nbsp; &nbsp;
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('required','1',false, array('id' => 'required1','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    {{ trans('backLang.customFieldsRequired') }} (*)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="default_val">
                                        <label for="default_value"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.customFieldsDefault') !!}
                                        </label>
                                        <div class="col-sm-10">
                                            {!! Form::text('default_value','', array('placeholder' => '','class' => 'form-control','id'=>'default_value')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="default_value"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.language') !!}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="lang_code" id="lang_code" class="form-control c-select">
                                                <option value="all">{{ trans('backLang.customFieldsForAllLang') }}</option>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                                    <option value="ar">العربية</option>
                                                @endif
                                                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <option value="en">English</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row m-t-md">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary m-t"><i
                                                        class="material-icons">
                                                    &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                                            <a href="{{ route('webmasterFields',[$WebmasterSections->id]) }}"
                                               class="btn btn-default m-t"><i class="material-icons">
                                                    &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                        </div>
                                    </div>

                                    {{Form::close()}}
                                </div>

                            @endif

                            @if (Session::get('fieldST') == "edit")
                                <div>
                                    {{Form::open(['route'=>['webmasterFieldsUpdate',$WebmasterSections->id,Session::get('WebmasterSectionField')->id],'method'=>'POST'])}}


                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group row">
                                            <label for="file_title_ar"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('title_ar',Session::get('WebmasterSectionField')->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'file_title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group row">
                                            <label for="file_title_en"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('title_en',Session::get('WebmasterSectionField')->title_en, array('placeholder' => '','class' => 'form-control','id'=>'file_title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="type0"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.customFieldsType') !!}</label>
                                        <div class="col-sm-3">
                                            <div class="radio">
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','0',(Session::get('WebmasterSectionField')->type==0) ? true : false, array('id' => 'type0','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType0') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','1',(Session::get('WebmasterSectionField')->type==1) ? true : false, array('id' => 'type1','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType1') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','2',(Session::get('WebmasterSectionField')->type==2) ? true : false, array('id' => 'type2','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType2') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','3',(Session::get('WebmasterSectionField')->type==3) ? true : false, array('id' => 'type3','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType3') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','4',(Session::get('WebmasterSectionField')->type==4) ? true : false, array('id' => 'type4','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType4') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','5',(Session::get('WebmasterSectionField')->type==5) ? true : false, array('id' => 'type5','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType5') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','6',(Session::get('WebmasterSectionField')->type==6) ? true : false, array('id' => 'type6','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType6') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','7',(Session::get('WebmasterSectionField')->type==7) ? true : false, array('id' => 'type7','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType7') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','8',(Session::get('WebmasterSectionField')->type==8) ? true : false, array('id' => 'type8','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType8') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','9',(Session::get('WebmasterSectionField')->type==9) ? true : false, array('id' => 'type9','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType9') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','10',(Session::get('WebmasterSectionField')->type==10) ? true : false, array('id' => 'type10','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType10') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','11',(Session::get('WebmasterSectionField')->type==11) ? true : false, array('id' => 'type11','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType11') }}
                                                    </label>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('type','12',(Session::get('WebmasterSectionField')->type==12) ? true : false, array('id' => 'type12','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.customFieldsType12') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="options"
                                             style="display: {{(Session::get('WebmasterSectionField')->type==6 || Session::get('WebmasterSectionField')->type==7) ? "inline" : "none"}}">
                                            @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                                <div class="col-sm-3 col-xs-5">
                                                    <div>
                                                        {!!  trans('backLang.customFieldsOptions') !!}
                                                        @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                                        :
                                                    </div>
                                                    {!! Form::textarea('details_ar',Session::get('WebmasterSectionField')->details_ar, array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.rtl'),'rows'=>'12','style'=>'white-space: nowrap;')) !!}
                                                    <small>
                                                        <i class="material-icons">&#xe8fd;</i> {!!  trans('backLang.customFieldsOptionsHelp') !!}
                                                    </small>
                                                </div>
                                            @endif
                                            @if(Helper::GeneralWebmasterSettings("ar_box_status") || Helper::GeneralWebmasterSettings("en_box_status"))
                                                <div class="col-sm-1 col-xs-1 text-center"
                                                     style="width: 30px !important;padding: 0;">
                                                    <br>
                                                    <?php
                                                    $i2 = 0;
                                                    ?>
                                                    @for($i=1;$i<=12;$i++)
                                                        <?php
                                                        $i2++;
                                                        $bg_volor = "#f0f0f0";
                                                        if ($i2 == 2) {
                                                            $i2 = 0;
                                                            $bg_volor = "#f9f9f9";
                                                        }
                                                        ?>
                                                        <div style="font-size: 1rem;line-height: 1.62;background: {{$bg_volor}}">
                                                            <small>
                                                                <small>{{$i}}</small>
                                                            </small>
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endif
                                            @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                                <div class="col-sm-3 col-xs-5">
                                                    <div>
                                                        {!!  trans('backLang.customFieldsOptions') !!}
                                                        @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                                        :
                                                    </div>
                                                    {!! Form::textarea('details_en',Session::get('WebmasterSectionField')->details_en, array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'rows'=>'12','style'=>'white-space: nowrap;')) !!}
                                                    <small>
                                                        <i class="material-icons">&#xe8fd;</i> {!!  trans('backLang.customFieldsOptionsHelp') !!}
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="required1"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.customFieldsRequired') !!}</label>
                                        <div class="col-sm-10">
                                            <div class="radio">
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('required','0',(Session::get('WebmasterSectionField')->required==0) ? true : false, array('id' => 'required2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    {{ trans('backLang.customFieldsOptional') }}
                                                </label>
                                                &nbsp; &nbsp;
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('required','1',(Session::get('WebmasterSectionField')->required==1) ? true : false, array('id' => 'required1','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    {{ trans('backLang.customFieldsRequired') }} (*)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="default_val"
                                         style="display: {{(Session::get('WebmasterSectionField')->type==8 || Session::get('WebmasterSectionField')->type==9 || Session::get('WebmasterSectionField')->type==10) ? "none" : "block"}}">
                                        <label for="default_value"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.customFieldsDefault') !!}
                                        </label>
                                        <div class="col-sm-10">
                                            {!! Form::text('default_value',Session::get('WebmasterSectionField')->default_value, array('placeholder' => '','class' => 'form-control','id'=>'default_value')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="default_value"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.language') !!}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="lang_code" id="lang_code" class="form-control c-select">
                                                <option value="all" {{ (Session::get('WebmasterSectionField')->lang_code=="all")?"selected='selected'":"" }}>{{ trans('backLang.customFieldsForAllLang') }}</option>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                                    <option value="ar" {{ (Session::get('WebmasterSectionField')->lang_code=="ar")?"selected='selected'":"" }}>
                                                        العربية
                                                    </option>
                                                @endif
                                                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <option value="en" {{ (Session::get('WebmasterSectionField')->lang_code=="en")?"selected='selected'":"" }}>
                                                        English
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="link_status"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                                        <div class="col-sm-10">
                                            <div class="radio">
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('status','1',(Session::get('WebmasterSectionField')->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    {{ trans('backLang.active') }}
                                                </label>
                                                &nbsp; &nbsp;
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('status','0',(Session::get('WebmasterSectionField')->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    {{ trans('backLang.notActive') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row m-t-md">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary m-t"><i
                                                        class="material-icons">
                                                    &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                            <a href="{{ route('webmasterFields',[$WebmasterSections->id]) }}"
                                               class="btn btn-default m-t"><i class="material-icons">
                                                    &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                        </div>
                                    </div>

                                    {{Form::close()}}
                                </div>
                            @endif
                        @else

                            @if(count($WebmasterSections->customFields)>0)
                                <div class="row p-a">
                                    <a class="btn btn-fw primary"
                                       href="{{route("webmasterFieldsCreate",[$WebmasterSections->id])}}">
                                        <i class="material-icons">&#xe02e;</i>
                                        &nbsp; {{ trans('backLang.customFieldsNewField') }}
                                    </a>
                                </div>
                            @endif
                            @if(count($WebmasterSections->customFields) == 0)
                                <div class="row p-a">
                                    <div class="col-sm-12">
                                        <div class=" p-a text-center light ">
                                            {{ trans('backLang.noData') }}
                                            <br>
                                            <br>
                                            <a class="btn btn-fw primary"
                                               href="{{route("webmasterFieldsCreate",[$WebmasterSections->id])}}">
                                                <i class="material-icons">&#xe02e;</i>
                                                &nbsp; {{ trans('backLang.customFieldsNewField') }}
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(count($WebmasterSections->customFields)>0)
                                {{Form::open(['route'=>['webmasterFieldsUpdateAll',$WebmasterSections->id],'method'=>'post'])}}
                                <div class="row">
                                    <table class="table table-striped  b-t">
                                        <thead>
                                        <tr>
                                            <th style="width:20px;">
                                                <label class="ui-check m-a-0">
                                                    <input id="checkAll4" type="checkbox"><i></i>
                                                </label>
                                            </th>
                                            <th>{{ trans('backLang.customFieldsTitle') }}</th>
                                            <th>{{ trans('backLang.customFieldsType') }}</th>
                                            <th class="text-center"
                                                style="width:120px;">{{ trans('backLang.customFieldsRequired') }}</th>
                                            <th class="text-center"
                                                style="width:100px;">{{ trans('backLang.language') }}</th>
                                            <th class="text-center"
                                                style="width:120px;">{{ trans('backLang.customFieldsStatus') }}</th>
                                            <th class="text-center"
                                                style="width:200px;">{{ trans('backLang.options') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $title_var = "title_" . trans('backLang.boxCode');
                                        $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                        ?>
                                        @foreach($WebmasterSections->customFields as $customField)
                                            <?php
                                            if ($customField->$title_var != "") {
                                                $field_title = $customField->$title_var;
                                            } else {
                                                $field_title = $customField->$title_var2;
                                            }

                                            $type_var = "customFieldsType" . $customField->type;
                                            ?>
                                            <tr>
                                                <td><label class="ui-check m-a-0">
                                                        <input type="checkbox" name="ids[]"
                                                               value="{{ $customField->id }}"><i
                                                                class="dark-white"></i>
                                                        {!! Form::hidden('row_ids[]',$customField->id, array('class' => 'form-control row_no')) !!}
                                                    </label>
                                                </td>
                                                <td>
                                                    {!! Form::text('row_no_'.$customField->id,$customField->row_no, array('class' => 'pull-left form-control row_no')) !!}
                                                    <small>
                                                        {!! $field_title !!}
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>
                                                        {{ trans('backLang.'.$type_var) }}
                                                    </small>
                                                </td>
                                                <td class="text-center">
                                                    <small>
                                                        {{ ($customField->required==1) ? trans('backLang.customFieldsRequired')."(*)":trans('backLang.customFieldsOptional') }}
                                                    </small>
                                                </td>

                                                <td class="text-center">
                                                    <small>
                                                        {{ $customField->lang_code }}
                                                    </small>
                                                </td>
                                                <td class="text-center">
                                                    <i class="fa {{ ($customField->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm success"
                                                       href="{{ route("webmasterFieldsEdit",["webmasterId"=>$WebmasterSections->id,"field_id"=>$customField->id]) }}">
                                                        <small><i class="material-icons">
                                                                &#xe3c9;</i> {{ trans('backLang.edit') }}</small>
                                                    </a>
                                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                                        <button class="btn btn-sm warning" data-toggle="modal"
                                                                data-target="#mf-{{ $customField->id }}"
                                                                ui-toggle-class="bounce"
                                                                ui-target="#animate">
                                                            <small><i class="material-icons">
                                                                    &#xe872;</i> {{ trans('backLang.delete') }}
                                                            </small>
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>
                                            <!-- .modal -->
                                            <div id="mf-{{ $customField->id }}" class="modal fade" data-backdrop="true">
                                                <div class="modal-dialog" id="animate">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                                        </div>
                                                        <div class="modal-body text-center p-lg">
                                                            <p>
                                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                                                <br>
                                                                <strong>[ {!! $field_title !!} ]</strong>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn dark-white p-x-md"
                                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                            <a href="{{ route("webmasterFieldsDestroy",["webmasterId"=>$WebmasterSections->id,"file_id"=>$customField->id]) }}"
                                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div>
                                            </div>
                                            <!-- / .modal -->
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs">
                                        <!-- .modal -->
                                        <div id="mf-all" class="modal fade" data-backdrop="true">
                                            <div class="modal-dialog" id="animate">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                                    </div>
                                                    <div class="modal-body text-center p-lg">
                                                        <p>
                                                            {{ trans('backLang.confirmationDeleteMsg') }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark-white p-x-md"
                                                                data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                        <button type="submit"
                                                                class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div>
                                        </div>
                                        <!-- / .modal -->

                                        <select name="action" id="action4"
                                                class="input-sm form-control w-sm inline v-middle" required>
                                            <option value="">{{ trans('backLang.bulkAction') }}</option>
                                            <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                            <option value="activate">{{ trans('backLang.activeSelected') }}</option>
                                            <option value="block">{{ trans('backLang.blockSelected') }}</option>
                                            @if(@Auth::user()->permissionsGroup->delete_status)
                                                <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                            @endif
                                        </select>
                                        <button type="submit" id="submit_all4"
                                                class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                                        <button id="submit_show_msg4" class="btn btn-sm white" data-toggle="modal"
                                                style="display: none"
                                                data-target="#mf-all" ui-toggle-class="bounce"
                                                ui-target="#animate">{{ trans('backLang.apply') }}
                                        </button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            @endif
                        @endif
                    </div>
                </div>
                {{-- End of Custom Fields --}}


                @if(Helper::GeneralWebmasterSettings("seo_status"))
                    <div class="tab-pane  {{ $tab_3 }}" id="tab_seo">

                        <div class="box-body">
                            {{Form::open(['route'=>['WebmasterSectionsSEOUpdate',$WebmasterSections->id],'method'=>'POST'])}}
                            <div class="row">
                                <div class="col-sm-6">
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOTitle') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                                {!! Form::text('seo_title_ar',$WebmasterSections->seo_title_ar, array('class' => 'form-control','id'=>'seo_title_ar','maxlength'=>'65', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.friendlyURL') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                                {!! Form::text('seo_url_slug_ar',$WebmasterSections->seo_url_slug_ar, array('class' => 'form-control','id'=>'seo_url_slug_ar', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEODesc') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                                {!! Form::textarea('seo_description_ar',$WebmasterSections->seo_description_ar, array('class' => 'form-control','id'=>'seo_description_ar','maxlength'=>'165', 'dir'=>trans('backLang.rtl'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOKeywords') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small>@endif

                                                {!! Form::textarea('seo_keywords_ar',$WebmasterSections->seo_keywords_ar, array('class' => 'form-control','id'=>'seo_keywords_ar', 'dir'=>trans('backLang.rtl'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif
                                </div>
                                <div class="col-sm-6">

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <?php
                                        $seo_example_title = str_replace("backLang.", "", trans('backLang.' . $WebmasterSections->name));
                                        $seo_example_desc = Helper::GeneralSiteSettings("site_desc_ar");
                                        if ($WebmasterSections->seo_title_ar != "") {
                                            $seo_example_title = $WebmasterSections->seo_title_ar;
                                        }
                                        if ($WebmasterSections->seo_description_ar != "") {
                                            $seo_example_desc = $WebmasterSections->seo_description_ar;
                                        }
                                        if ($WebmasterSections->seo_url_slug_ar != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            $seo_example_url = url($WebmasterSections->seo_url_slug_ar);
                                        } else {
                                            $seo_example_url = url($WebmasterSections->name);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <div>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif
                                                &nbsp;
                                                <div class="search-example" dir="rtl">
                                                    <a id="title_in_engines_ar" href="{{ $seo_example_url }}"
                                                       target="_blank">{{ $seo_example_title }}</a>
                                                    <span id="url_in_engines_ar">{{ $seo_example_url }}</span>
                                                    <div id="desc_in_engines_ar">{{ $seo_example_desc }} ...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <i class="material-icons">&#xe8fd;</i>
                                                <small>{!!  trans('backLang.seoTabSettings') !!}</small>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">

                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOTitle') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::text('seo_title_en',$WebmasterSections->seo_title_en, array('class' => 'form-control','id'=>'seo_title_en','maxlength'=>'65', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.friendlyURL') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::text('seo_url_slug_en',$WebmasterSections->seo_url_slug_en, array('class' => 'form-control','id'=>'seo_url_slug_en', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEODesc') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::textarea('seo_description_en',$WebmasterSections->seo_description_en, array('class' => 'form-control','id'=>'seo_description_en','maxlength'=>'165', 'dir'=>trans('backLang.ltr'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOKeywords') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::textarea('seo_keywords_en',$WebmasterSections->seo_keywords_en, array('class' => 'form-control','id'=>'seo_keywords_en', 'dir'=>trans('backLang.ltr'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                                    &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                            <a href="{{ route('WebmasterSectionsEdit',$WebmasterSections->id) }}"
                                               class="btn btn-default m-t"><i class="material-icons">
                                                    &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                </div>

                                <div class="col-sm-6">
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <?php
                                        $seo_example_title = str_replace("backLang.", "", trans('backLang.' . $WebmasterSections->name));
                                        $seo_example_desc = Helper::GeneralSiteSettings("site_desc_en");
                                        if ($WebmasterSections->seo_title_en != "") {
                                            $seo_example_title = $WebmasterSections->seo_title_en;
                                        }
                                        if ($WebmasterSections->seo_description_en != "") {
                                            $seo_example_desc = $WebmasterSections->seo_description_en;
                                        }
                                        if ($WebmasterSections->seo_url_slug_en != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            $seo_example_url = url($WebmasterSections->seo_url_slug_en);
                                        } else {
                                            $seo_example_url = url($WebmasterSections->name);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <div>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif
                                                &nbsp;
                                                <div class="search-example" dir="ltr">
                                                    <a id="title_in_engines_en" href="{{ $seo_example_url }}"
                                                       target="_blank">{{ $seo_example_title }}</a>
                                                    <span id="url_in_engines_en">{{ $seo_example_url }}</span>
                                                    <div id="desc_in_engines_en">{{ $seo_example_desc }} ...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <i class="material-icons">&#xe8fd;</i>
                                                <small>{!!  trans('backLang.seoTabSettings') !!}</small>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif
                                </div>
                            </div>


                            {{Form::close()}}
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
@section('footerInclude')
    <script type="text/javascript">
        $("#checkAll4").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $("#action4").change(function () {
            if (this.value == "delete") {
                $("#submit_all4").css("display", "none");
                $("#submit_show_msg4").css("display", "inline-block");
            } else {
                $("#submit_all4").css("display", "inline-block");
                $("#submit_show_msg4").css("display", "none");
            }
        });
        $("input:radio[name=type]").click(function () {
            if ($(this).val() == 6 || $(this).val() == 7) {
                $("#options").css("display", "inline");
            } else {
                $("#options").css("display", "none");
            }
            if ($(this).val() == 8 || $(this).val() == 9 || $(this).val() == 10) {
                $("#default_val").css("display", "none");
            } else {
                $("#default_val").css("display", "block");
            }
        });

        // Js Slug
        function slugify(string) {
            return string
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        }

        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
        $("#seo_title_ar").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#title_in_engines_ar").text($(this).val());
            } else {
                $("#title_in_engines_ar").text("<?php echo str_replace("backLang.", "", trans('backLang.' . $WebmasterSections->name)); ?>");
            }
        });
        $("#seo_description_ar").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#desc_in_engines_ar").text($(this).val());
            } else {
                $("#desc_in_engines_ar").text("<?php echo Helper::GeneralSiteSettings("site_desc_ar"); ?>");
            }
        });
        $("#seo_url_slug_ar").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#url_in_engines_ar").text("<?php echo url(''); ?>/" + slugify($(this).val()));
            } else {
                $("#url_in_engines_ar").text("<?php echo url($WebmasterSections->name); ?>");
            }
        });
        @endif
        @if(Helper::GeneralWebmasterSettings("en_box_status"))
        $("#seo_title_en").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#title_in_engines_en").text($(this).val());
            } else {
                $("#title_in_engines_en").text("<?php echo str_replace("backLang.", "", trans('backLang.' . $WebmasterSections->name)); ?>");
            }
        });
        $("#seo_description_en").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#desc_in_engines_en").text($(this).val());
            } else {
                $("#desc_in_engines_en").text("<?php echo Helper::GeneralSiteSettings("site_desc_en"); ?>");
            }
        });
        $("#seo_url_slug_en").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#url_in_engines_en").text("<?php echo url(''); ?>/" + slugify($(this).val()));
            } else {
                $("#url_in_engines_en").text("<?php echo str_replace("backLang.", "", trans('backLang.' . $WebmasterSections->name)); ?>");
            }
        });
        @endif
    </script>
@endsection
