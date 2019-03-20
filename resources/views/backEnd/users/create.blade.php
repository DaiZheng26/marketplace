@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ trans('backLang.newUser') }}</h3>
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
                {{Form::open(['route'=>['usersStore'],'method'=>'POST', 'files' => true ])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.fullName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name','', array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.loginEmail') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('email','', array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.loginPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('password','', array('placeholder' => '','class' => 'form-control','id'=>'password','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="photo"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.personalPhoto') !!}</label>
                    <div class="col-sm-10">
                        {!! Form::file('photo', array('class' => 'form-control','id'=>'photo','accept'=>'image/*')) !!}
                        <small>
                            <i class="material-icons">&#xe8fd;</i>
                            {!!  trans('backLang.imagesTypes') !!}
                        </small>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="permissions1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.Permission') !!}</label>
                    <div class="col-sm-10">
                        <select name="permissions_id" id="permissions_id" required class="form-control c-select">
                            <option value="">- - {!!  trans('backLang.selectPermissionsType') !!} - -</option>
                            @foreach ($Permissions as $Permission)
                                <option value="{{ $Permission->id  }}">{{ $Permission->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

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
                        {!! Form::email('connect_email','', array('placeholder' => '','class' => 'form-control','id'=>'connect_email')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="connect_password"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.connectPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('connect_password','', array('placeholder' => '','class' => 'form-control','id'=>'connect_password')) !!}
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
