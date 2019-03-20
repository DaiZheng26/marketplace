@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe03b;</i> {{ trans('backLang.newPermissions') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.settings') }}</a> /
                    <a href="">{{ trans('backLang.usersPermissions') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("users")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['permissionsStore'],'method'=>'POST'])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.title') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name','', array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label for="permissions1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.dataManagements') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('view_status','1',true, array('id' => 'view_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.dataManagements1') }}
                            </label>
                            <br>
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('view_status','0',false, array('id' => 'view_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.dataManagements2') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="analytics_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.activeApps') !!}
                    </label>
                    <div class="col-sm-10">


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('analytics_status','1',false, array('id' => 'analytics_status')) !!}
                                <i class="dark-white"></i><label
                                        for="analytics_status">{{ trans('backLang.visitorsAnalytics') }}</label>
                            </label>
                        </div>


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('newsletter_status','1',false, array('id' => 'newsletter_status')) !!}
                                <i class="dark-white"></i><label
                                        for="newsletter_status">{{ trans('backLang.newsletter') }}</label>
                            </label>
                        </div>


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('inbox_status','1',false, array('id' => 'inbox_status')) !!}
                                <i class="dark-white"></i><label
                                        for="inbox_status">{{ trans('backLang.siteInbox') }}</label>
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('calendar_status','1',false, array('id' => 'calendar_status')) !!}
                                <i class="dark-white"></i><label
                                        for="calendar_status">{{ trans('backLang.calendar') }}</label>
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('banners_status','1',false, array('id' => 'banners_status')) !!}
                                <i class="dark-white"></i><label
                                        for="banners_status">{{ trans('backLang.adsBanners') }}</label>
                            </label>
                        </div>


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('settings_status','1',false, array('id' => 'settings_status')) !!}
                                <i class="dark-white"></i><label
                                        for="settings_status">{{ trans('backLang.generalSettings') }}</label>
                            </label>
                        </div>


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('webmaster_status','1',false, array('id' => 'webmaster_status')) !!}
                                <i class="dark-white"></i><label
                                        for="webmaster_status">{{ trans('backLang.webmasterTools') }}</label>
                            </label>
                        </div>

                    </div>
                </div>


                <div class="form-group row">
                    <label for="data_sections0"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.activeSiteSections') !!}
                    </label>
                    <div class="col-sm-10">

                        <?php $i = 0; ?>
                        @foreach($GeneralWebmasterSections as $WebmasterSection)
                            <div class="checkbox">
                                <label class="ui-check">
                                    {!! Form::checkbox('data_sections[]',$WebmasterSection->id,false, array('id' => 'data_sections'.$i)) !!}
                                    <i class="dark-white"></i><label
                                            for="data_sections{{$i}}">{!! str_replace("backLang.","",trans('backLang.'.$WebmasterSection->name)) !!}</label>
                                </label>
                            </div>
                                <?php $i++; ?>
                        @endforeach

                    </div>
                </div>


                <div class="form-group row">
                    <label for="add_status1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.addPermission') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('add_status','1',true, array('id' => 'add_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            <br>
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('add_status','0',false, array('id' => 'add_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="edit_status1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.editPermission') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('edit_status','1',true, array('id' => 'edit_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            <br>
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('edit_status','0',false, array('id' => 'edit_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="delete_status1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.deletePermission') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('delete_status','1',true, array('id' => 'delete_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            <br>
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('delete_status','0',false, array('id' => 'delete_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{route("users")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection
