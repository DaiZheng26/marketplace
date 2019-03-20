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
                    <a class="navbar-brand"><img src="{{ URL::to('backEnd/assets/images/logo.png') }}" alt="."> <span class="hidden-folded inline">{{ trans('backLang.control') }}</span></a>
                </div>
            </div>
        </div>
        <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
            <div class="m-b">
                {{ trans('backLang.forgotPassword') }}
                <p class="text-xs m-t">{{ trans('backLang.enterYourEmail') }}</p>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form name="reset" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                <div class="md-form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email"  name="email" value="{{ old('email') }}" class="md-input" required>
                    <label>{{ trans('backLang.yourEmail') }}</label>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <button type="submit" class="btn primary btn-block p-x-md">{{ trans('backLang.sendPasswordResetLink') }}</button>
            </form>
        </div>
        <p id="alerts-container"></p>
        <div class="p-v-lg text-center">{{ trans('backLang.returnTo') }} <a href="{{ url('/login') }}" class="text-primary _600">{{ trans('backLang.signIn') }}</a></div>
    </div>

    <!-- ############ LAYOUT END-->


</div>
@include('backEnd.includes.foot')
</body>
</html>