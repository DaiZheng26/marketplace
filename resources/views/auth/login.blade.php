<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('backEnd.includes.head')
</head>
<body>
<div class="app" id="app">

    <!-- ############ LAYOUT START-->
    <div class="center-block w-xxl w-auto-xs p-y-md">
        <div class="navbar">
            <div class="pull-center">
                <div>
                    <a class="navbar-brand"><img src="{{ URL::to('backEnd/assets/images/logo.png') }}" alt="."> <span
                                class="hidden-folded inline">{{ trans('backLang.control') }}</span></a>
                </div>
            </div>
        </div>
        <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
            <div class="m-b text-sm">
                {{ trans('backLang.signedInToControl') }}
            </div>
            <form name="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
                <div class="md-form-group float-label {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" value="{{ old('email') }}" class="md-input" required>
                    <label>{{ trans('backLang.connectEmail') }}</label>
                </div>
                <div class="md-form-group float-label {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="md-input" required>
                    <label>{{ trans('backLang.connectPassword') }}</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <div class="m-b-md">
                    <label class="md-check">
                        <input type="checkbox" name="remember"><i
                                class="primary"></i> {{ trans('backLang.keepMeSignedIn') }}
                    </label>
                </div>
                <button type="submit" class="btn primary btn-block p-x-md">{{ trans('backLang.signIn') }}</button>
            </form>
            @if(Helper::GeneralWebmasterSettings("register_status"))
                <br>
                <div class="text-center">
                    <a href="{{ url('/register') }}" class="btn info btn-block p-x-md"><i class="material-icons">&#xe7fe;</i> {{ trans('backLang.createNewAccount') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="p-v-lg text-center">
            <div class="m-b"><a href="{{ url('/password/reset') }}"
                                class="text-primary _600">{{ trans('backLang.forgotPassword') }}</a></div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->


</div>
@include('backEnd.includes.foot')
</body>
</html>

