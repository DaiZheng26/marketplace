@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.sectionEdit') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    {{ trans('backLang.webmasterTools') }} /
                    <a href="">{{ trans('backLang.adsBannersSettings') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("WebmasterBanners")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['WebmasterBannersUpdate',$WebmasterBanners->id],'method'=>'POST'])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}</label>
                    <div class="col-sm-10">
                        {!! Form::text('name',$WebmasterBanners->name, array('placeholder' => trans('backLang.langVar'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.sectionType') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','0',($WebmasterBanners->type==0) ? true : false, array('id' => 'site_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.sectionTypeCode') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','1',($WebmasterBanners->type==1) ? true : false, array('id' => 'site_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.sectionTypePhoto') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','2',($WebmasterBanners->type==2) ? true : false, array('id' => 'site_status3','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.sectionTypeVideo') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="width"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.size') !!}</label>
                    <div class="col-sm-2">
                        {!! Form::number('width',$WebmasterBanners->width, array('placeholder' => trans('backLang.width'),'class' => 'form-control','id'=>'width','required'=>'','min'=>'0')) !!}
                    </div>
                    <div class="col-sm-1 text-center" style="width: 30px !important;padding-top: 10px;">
                        X
                    </div>
                    <div class="col-sm-2">
                        {!! Form::number('height',$WebmasterBanners->height, array('placeholder' => trans('backLang.height'),'class' => 'form-control','id'=>'height','required'=>'','min'=>'0')) !!}
                    </div>
                    <div class="col-sm-1 text-center" style="width: 30px !important;padding-top: 10px;">
                        PX
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desc_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.descriptionBox') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('desc_status','1',($WebmasterBanners->desc_status==1) ? true : false, array('id' => 'desc_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('desc_status','0',($WebmasterBanners->desc_status==0) ? true : false, array('id' => 'desc_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkBox') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('link_status','1',($WebmasterBanners->link_status==1) ? true : false, array('id' => 'link_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('link_status','0',($WebmasterBanners->link_status==0) ? true : false, array('id' => 'link_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon_status1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.iconPicker') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('icon_status','1',($WebmasterBanners->icon_status==1) ? true : false, array('id' => 'icon_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('icon_status','0',($WebmasterBanners->icon_status==0) ? true : false, array('id' => 'icon_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','1',($WebmasterBanners->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.active') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','0',($WebmasterBanners->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
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
                        <a href="{{route("WebmasterBanners")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection
