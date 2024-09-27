@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <form class="login-form" action="{{ route('login') }}" method="post" id="login_form">
        @csrf
        <h3 class="form-title uppercase" style="color: #FB4600">Sign In</h3>
        @include('errormessage')
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" id="email" autocomplete="off"
                placeholder="Email" name="email" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password"
                autocomplete="off" placeholder="Password" name="password" />
        </div>
        <div class="form-actions">
            <button type="submit" class="btn uppercase submitbutton"
                style="background-color: #FB4600; color: white">Login</button>
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" />Remember
                <span></span>
            </label>
            {{-- <a href="{{ route('password.request') }}" id="forget-password" class="forget-password">Forgot Password?</a> --}}
        </div>
        <div class="create-account">
            <p>
                <a href="" id="register-btn" class="uppercase"></a>
            </p>
        </div>
    </form>
@section('script')
    <script>
        $(document).ready(function() {

            $('#login_form').validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 50,
                        email: true
                    },
                    password: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    if ($("form").validate().checkForm()) {
                        $(".submitbutton").attr("type", "button");
                        $(".submitbutton").addClass("disabled");
                        form.submit();
                    }
                }
            });

        });
    </script>
@endsection
@endsection
