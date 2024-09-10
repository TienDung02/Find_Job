
@extends('frontend.layout.layout')

@section('content')
    <!-- Titlebar
================================================== -->
    <div id="titlebar" class="single margin-top-90">
        <div class="container">

            <div class="sixteen columns">
                <h2>My Account</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li>You are here:</li>
                        <li><a href="#">Home</a></li>
                        <li>My Account</li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>


    <!-- Content
    ================================================== -->
    <!-- Container -->
    <div class="container">
        <div class="my-account">
            <ul class="tabs-nav">
                <p class="form-row d-flex form-row-wide">
                    <input type="button" value="Login" class="type_reg login active">
                    <input type="button" value="Register" class="type_reg register">
                </p>
            </ul>
            <div class="tabs-container">
                <!-- Login -->
                <div class="tab-content" id="tab1">
                    <h3 class="margin-bottom-10 margin-top-10">Login</h3>
                    <form method="post" class="login" action="{{route('auth')}}">
                        @csrf
                        <p class="form-row form-row-wide">
                            <label for="username">Email Address:</label>
                            {{--                            <input type="text" class="input-text" name="user_name" id="username" value="" />--}}
                            <input id="email" type="email" class="form-control input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="password">Password:</label>
                            {{--                            <input class="input-text" type="password" name="password" id="password" />--}}
                            <input id="password" type="password" class="form-control input-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </p>

                        <p class="form-row">
                            <input type="submit" class="button" name="login" value="Login" />

                            <label for="rememberme" class="rememberme">
                                <input name="rememberme" type="checkbox" id="rememberme" value="forever" {{ old('remember') ? 'checked' : '' }}/> Remember Me</label>
                        {{--                            @if (Route::has('password.request'))--}}
                        <p class="lost_password">
                            <a href="" >Lost Your Password?</a>
                        </p>
                        {{--                        @endif--}}
                        </p>

                    </form>
                </div>

                <!-- Register -->
                <div class="tab-content d-none" id="tab2" >

                    <h3 class="margin-bottom-10 margin-top-10">Register</h3>

                    <form method="post" class="register" action="{{route('auth.register')}}">
                        @csrf
                        <p class="form-row d-flex form-row-wide">
                            <input type="button" value="Candidate" class="type_reg candidate_reg active">
                            <input type="button" value="Employer" class="type_reg employer_reg">
                            <input type="hidden"  name="type_register" id="reg_type" value="2" />
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="reg_email">First name:</label>
                            <input type="text" class="input-text mb-3" name="first_name" value="" placeholder="First name" required/>
                            <label for="reg_email">Last name:</label>
                            <input type="text" class="input-text" name="last_name" value="" placeholder="Last name" required/>
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="reg_password">Email:</label>
                            <input type="email" class="input-text" name="email" id="reg_password" placeholder="Email" required/>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </p>

                        <p class="form-row">
                            <input type="submit" class="button" name="register" value="Register" />
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
