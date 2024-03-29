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
    body{
        overflow-x:hidden;
    }
 .bg {
animation:slide 8s ease-in-out infinite alternate;
background-image: linear-gradient(-60deg, rgb(167 136 168 / 26%) 50%, rgb(124 12 17) 50%);
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
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label ">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
