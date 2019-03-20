@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ trans('backLang.sectionNew') }}</h3>
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
            <div class="box-body">
                {{Form::open(['route'=>['WebmasterSectionsStore'],'method'=>'POST'])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}</label>
                    <div class="col-sm-10">
                        {!! Form::text('name','', array('placeholder' => trans('backLang.langVar'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.sectionType') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <div style="margin-bottom: 5px;">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('type','0',true, array('id' => 'site_status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.typeTextPages') }}
                                </label>
                            </div>
                            <div style="margin-bottom: 5px;">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('type','1',false, array('id' => 'site_status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.typePhotos') }}
                                </label>
                            </div>
                            <div style="margin-bottom: 5px;">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('type','2',false, array('id' => 'site_status3','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.typeVideos') }}
                                </label>
                            </div>
                            <div style="margin-bottom: 5px;">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('type','3',false, array('id' => 'site_status4','class'=>'has-value')) !!}
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
                                    {!! Form::radio('sections_status','0',true, array('id' => 'sections_status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.withoutCategories') }}
                                </label>
                            </div>
                            <div style="margin-bottom: 5px;">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('sections_status','1',false, array('id' => 'sections_status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.mainCategoriesOnly') }}
                                </label>
                            </div>
                            <div style="margin-bottom: 5px;">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('sections_status','2',false, array('id' => 'sections_status3','class'=>'has-value')) !!}
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
                                {!! Form::radio('date_status','1',true, array('id' => 'date_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('date_status','0',false, array('id' => 'date_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('expire_date_status','1',true, array('id' => 'expire_date_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('expire_date_status','0',false, array('id' => 'expire_date_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('longtext_status','1',true, array('id' => 'longtext_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('longtext_status','0',false, array('id' => 'longtext_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('editor_status','1',true, array('id' => 'editor_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('editor_status','0',false, array('id' => 'editor_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('attach_file_status','1',true, array('id' => 'attach_file_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('attach_file_status','0',false, array('id' => 'attach_file_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('section_icon_status','1',true, array('id' => 'section_icon_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('section_icon_status','0',false, array('id' => 'section_icon_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('icon_status','1',true, array('id' => 'icon_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('icon_status','0',false, array('id' => 'icon_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('multi_images_status','1',true, array('id' => 'multi_images_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('multi_images_status','0',false, array('id' => 'multi_images_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('extra_attach_file_status','1',true, array('id' => 'extra_attach_file_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('extra_attach_file_status','0',false, array('id' => 'extra_attach_file_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('maps_status','1',true, array('id' => 'maps_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('maps_status','0',false, array('id' => 'maps_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('order_status','1', true, array('id' => 'order_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('order_status','0',false, array('id' => 'order_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('comments_status','1',true, array('id' => 'comments_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('comments_status','0',false, array('id' => 'comments_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('related_status','1', true, array('id' => 'related_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('related_status','0', false , array('id' => 'related_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{route("WebmasterSections")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection
