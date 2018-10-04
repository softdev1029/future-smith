@extends('backend.layouts.simple')

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/admin/js/jquery.validate.min.js') }}" defer></script>

    <!-- Page Javascript -->
@endpush

@section('content')

<div class="form-outer text-center d-flex align-items-center">
    <div class="form-inner">
        <div class="logo text-uppercase"><img src="{{ asset('images/commons/logo.png') }}" /></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
        <form id="login-form" method="post" action="{{ route('admin.login') }}">
            @csrf

            {{ show_messages() }}

            <div class="form-group">
                <label for="login-username" class="label-custom">{{ __('E-Mail Address') }}</label>
                <input id="login-username" type="text" name="email" required="">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="login-password" class="label-custom">{{ __('Password') }}</label>
                <input id="login-password" type="password" name="password" required="">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <button id="login" class="btn btn-primary">Login</a>
        </form>
    </div>
</div>

@endsection
