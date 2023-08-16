@extends('layouts.app')

@section('content')
<style>
    .nav-item{
        display:flex;
    }
    .nav-item svg{
        color:black;
    }
    .navbar-nav .nav-item{
        margin-left:10%;
    }

    .navbar-nav .nav-item a{
        color:black !important;
        font-weight:600;
        font-size:16px;
    }
    body{
        overflow-x:hidden;
    }
 .bg {
animation:slide 8s ease-in-out infinite alternate;
background-image: linear-gradient(-60deg, rgb(84 236 5 / 26%) 50%, rgb(12 124 36) 50%);
bottom:0;
left:-50%;
opacity:.5;
position:absolute;
right:-50%;
top:0;
z-index:-1;
}
.bg2 {
animation-direction:alternate-reverse;
animation-duration:10s;
}
.bg3 {
animation-duration:5s;

}
@keyframes slide {
0% {
  transform:translateX(-25%);
}
100% {
  transform:translateX(25%);
}
}
.card{
    background-color: #fff9;
    border:none;
    padding:15%;
}
.card-header{
    background:transparent;
    color:black;
    font-size:40px;
    font-weight:600;
}
.btn-primary{
    background:black !important;
}
.btn-link{
color:black;
text-transform:none;
}
    </style>

<div class="container">
<div class="bg">
       
       </div>
       <div class="bg bg2">
    
       </div>
       <div class="bg bg3"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
