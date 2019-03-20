@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.editUser') }}</h3>
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
                {{Form::open(['route'=>['usersUpdate',$Users->id],'method'=>'POST', 'files' => true])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.fullName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name',$Users->name, array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.loginEmail') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('email',$Users->email, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.loginPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('password','', array('placeholder' => '','class' => 'form-control','id'=>'password')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="photo_file"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
                    <div class="col-sm-10">
                        @if($Users->photo!="")
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="user_photo" class="col-sm-4 box p-a-xs">
                                        <a target="_blank"
                                           href="{{ URL::to('uploads/users/'.$Users->photo) }}"><img
                                                    src="{{ URL::to('uploads/users/'.$Users->photo) }}"
                                                    class="img-responsive">
                                            {{ $Users->photo }}
                                        </a>
                                        <br>
                                        <a onclick="document.getElementById('user_photo').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                           class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                                    </div>
                                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                        <a onclick="document.getElementById('user_photo').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                            <i class="material-icons">&#xe166;</i> {!!  trans('backLang.undoDelete') !!}
                                        </a>
                                    </div>

                                    {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                                </div>
                            </div>
                        @endif

                        {!! Form::file('photo', array('class' => 'form-control','id'=>'photo','accept'=>'image/*')) !!}
                        <small>
                            <i class="material-icons">&#xe8fd;</i>
                            {!!  trans('backLang.imagesTypes') !!}
                        </small>
                    </div>
                </div>

                @if(@Auth::user()->permissionsGroup->webmaster_status)
                    <div class="form-group row">
                        <label for="permissions1"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.Permission') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <select name="permissions_id" id="permissions_id" required
                                        class="form-control c-select">
                                    <option value="">- - {!!  trans('backLang.selectPermissionsType') !!} - -</option>
                                    @foreach ($Permissions as $Permission)
                                        <option value="{{ $Permission->id  }}" {!! ($Users->permissions_id==$Permission->id) ? "selected='selected'":"" !!}>{{ $Permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="link_status"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('status','1',($Users->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.active') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('status','0',($Users->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.notActive') }}
                                </label>
                            </div>
                        </div>
                    </div>
                @else
                    {!! Form::hidden('permissions_id',$Users->permissions_id) !!}
                    {!! Form::hidden('status',$Users->status) !!}

                @endif
                <div class="form-group row">
                    <div class="col-sm-12">
                        <strong>{{ trans('backLang.connectEmailToConnect') }}</strong>
                        <hr>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="connect_email"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.connectEmail') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('connect_email',$Users->connect_email, array('placeholder' => '','class' => 'form-control','id'=>'connect_email')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="connect_password"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.connectPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('connect_password',$Users->connect_password, array('placeholder' => '','class' => 'form-control','id'=>'connect_password')) !!}
                    </div>
                </div>

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.update') !!}</button>
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
