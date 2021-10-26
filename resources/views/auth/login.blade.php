@extends('layouts.app')
@section('content')

    <body class="fo-login">
        <div class="d-flex justify-content-center">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{ asset('images/faces.png') }}" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            </div>
                            <input type="text" name="email" id="email" class="form-control input_user" placeholder="">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value="" placeholder="">
                        </div>

                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="logins" id="logins" class="btn login_btn"
                                value="log">Entrar</button>

                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">

                            <a href="{{ route('viewChange') }}">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
