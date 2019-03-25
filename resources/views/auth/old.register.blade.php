@if(Helper::GeneralWebmasterSettings("register_status"))
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
                {{ trans('backLang.newUser') }}
            </div>
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                @if ($errors->has('name'))
                    <div class="alert alert-warning">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-warning">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="md-form-group">
                    <input id="name" type="text" class="md-input" name="name" value="{{ old('name') }}" required
                           autofocus>
                    <label>{{ trans('backLang.fullName') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="email" type="email" class="md-input" name="email" value="{{ old('email') }}" required>

                    <label>{{ trans('backLang.connectEmail') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="password" type="password" class="md-input" name="password" required>
                    <label>{{ trans('backLang.connectPassword') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="password-confirm" type="password" class="md-input" name="password_confirmation" required>
                    <label>{{ trans('backLang.confirmPassword') }}</label>
                </div>

                <button type="submit" class="btn primary btn-block p-x-md"><i
                            class="material-icons">&#xe7fe;</i> {{ trans('backLang.createNewAccount') }}</button>
            </form>
        </div>

        <div class="p-v-lg text-center">
            <div>{{ trans('backLang.signedInToControl') }} <a href="{{ url('/login') }}"
                                                              class="text-primary _600">{{ trans('backLang.signIn') }}</a>
            </div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->


</div>
@include('backEnd.includes.foot')
</body>
</html>
@else
    <script>
        window.location.href = '{{url("/login")}}';
    </script>
@endif

