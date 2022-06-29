@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-basic px-2">
  <div class="auth-inner my-2">
    <!-- Login basic -->
    <div class="card mb-0">
      <div class="card-body">
        <div class="brand-logo">
            <svg version="1.1" id="Lager_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 500 80" style="enable-background:new 0 0 500 80" xml:space="preserve"><style>.st0{fill:#1a171b}.st1{fill:#cf0b1c}</style><path id="XMLID_7_" class="st0" d="M35.1 28.2v-9.7H74c13 0 19.4 5.4 19.4 16.2v16.2c0 8.6-6.5 13-19.4 13H35.1v-26h13v16.2H74c4.3 0 6.5-2.2 6.5-6.5v-13c0-4.3-2.2-6.5-6.5-6.5H35.1z"/><path id="XMLID_11_" class="st0" d="m110.4 54.1-4.9 9.7H90.9L110.4 25c2.2-4.3 5.4-6.5 9.7-6.5h3.2c4.3 0 7.6 2.2 9.7 6.5l19.4 38.9h-14.6l-4.9-9.7h-22.5zm-3.3-48.5h13v9.7h-13V5.6zm21.1 38.8-6.5-13-6.5 13h13zm-4.9-38.8h13v9.7h-13V5.6z"/><path id="XMLID_2_" class="st0" d="M205.9 54.1v9.7h-32.4c-13 0-19.4-5.4-19.4-16.2v-13c0-10.8 6.5-16.2 19.4-16.2h32.4v9.7h-32.4c-4.3 0-6.5 2.2-6.5 6.5v13c0 4.3 2.2 6.5 6.5 6.5h32.4z"/><path id="XMLID_1_" class="st0" d="M254.5 18.5h16.2l-24 18.2 33.7 40.1h-14.6L237 44l-14.9 11.3v8.5h-13V18.5h13V43z"/><path id="XMLID_13_" class="st1" d="M288.2 48c0 4.4 2.2 6.5 6.5 6.5h32.7v9.8h-32.7c-13.1 0-19.6-5.5-19.6-16.4V18.5h13.1V48z"/><path id="XMLID_12_" class="st1" d="M330.8 18.5h13.1v45.8h-13.1z"/><path id="XMLID_10_" class="st1" d="M360.2 33.2v31.1h-13.1V33.2c0-9.8 5.5-14.7 16.4-14.7 4.8 0 8.6 2.2 11.5 6.5l16.4 24.5c1.1 1.1 2.1 1.6 3.1 1.6 1.2 0 1.8-.5 1.8-1.6v-31h13.1v31.1c0 9.8-5.5 14.7-16.4 14.7-4.8 0-8.6-2.2-11.5-6.5l-16.4-24.5c-1.1-1.1-2.1-1.6-3.1-1.6-1.2-.1-1.8.4-1.8 1.5"/><path id="XMLID_9_" class="st1" d="M425.6 46.3V48c0 4.4 2.2 6.5 6.5 6.5h32.7v9.8h-32.7c-13.1 0-19.6-5.5-19.6-16.4v-13c0-10.9 6.5-16.4 19.6-16.4h32.7v9.8H432c-4.4 0-6.5 2.2-6.5 6.5v1.6h39.3v9.8h-39.2z"/></svg>
        </div>

        <form class="auth-login-form mt-2" action="login" method="POST">
            {{ csrf_field() }}
          <div class="mb-1">
            <label for="login-email" class="form-label">Email</label>
            <input
                type="text"
                class="form-control @error('email') error @enderror"
                id="login-email"
                name="email"
                placeholder="john@example.com"
                aria-describedby="email"
                tabindex="1"
                value="{{ old('email') }}"
                autofocus
            />
            @error('email')
                <span id="login-email-error" class="error">{{ $message }}</span>
            @enderror

          </div>

          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="login-password">Password</label>
              <a href="{{url('auth/forgot-password-basic')}}">
                <small>Forgot Password?</small>
              </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge @error('password') error @enderror"
                id="login-password"
                name="password"
                tabindex="2"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="login-password"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
                <span id="login-password-error" class="error">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3" />
              <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
        </form>


      </div>
    </div>
    <!-- /Login basic -->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
@endsection
