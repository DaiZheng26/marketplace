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
            <div class="m-b">
                {{ trans('backLang.resetPassword') }}
            </div>
            <form name="reset" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <div class="md-form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" value="{{ $email or old('email') }}" class="md-input" required>
                    <label>{{ trans('backLang.yourEmail') }}</label>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <div class="md-form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="md-input" required>
                    <label>{{ trans('backLang.newPassword') }}</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif


                <div class="md-form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="md-input" required>
                    <label>{{ trans('backLang.confirmPassword') }}</label>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif

                <button type="submit" class="btn primary btn-block p-x-md">{{ trans('backLang.resetPassword') }}</button>
            </form>
        </div>
    </div>

    <!-- ############ LAYOUT END-->


</div>
@include('backEnd.includes.foot')
</body>
</html>
