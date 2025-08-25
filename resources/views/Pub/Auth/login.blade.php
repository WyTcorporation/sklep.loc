@extends('Pub::layouts.layout')


@section('content')

    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="/auths/login">{!!__('front.login_title') !!}</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    {{--      <p class="login-box-msg">Sign in to start your session</p>--}}
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="input-group mb-3">
                            <input id="email" type="email"
                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}"
                                   required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password"
                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" placeholder="{{ __('Password') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{--          <div class="col-8">--}}
                            {{--            <div class="icheck-primary">--}}
                            {{--              <input type="checkbox" id="remember">--}}
                            {{--              <label for="remember">--}}
                            {{--                Remember Me--}}
                            {{--              </label>--}}
                            {{--            </div>--}}
                            {{--          </div>--}}
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit"
                                        class="btn btn-primary btn-block">{{__('front.login_enter')}}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
@endsection
