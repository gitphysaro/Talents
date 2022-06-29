@extends('layouts.app')

@section('content')
<div class="container">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="row justify-content-center"> 
                <div class="col-md-3">
                <!-- <img class="card-img-top" src="images/image.png" alt="Card image cap" > -->
                <img style="width: 250px;" class="card-img-top" src="./images/physaro.png" alt="Card image cap">
                </div>
    </div>
   
    <br/>
        <div class="row justify-content-center"> 
        <div class="col-md-6">
            <div class="card ">
                
                <div class="card-header" ><h4 style="text-align: center">TALENTS</h4></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Identifiant CRC') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required >

                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('status'))
                                <div class="alert" id="alerte">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                   <strong style="color:red"> {{ session('status') }}</strong>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- <button type="submit" class="btn " style="background-color: #187AAC; color: white">
                                    {{ __('Se connecter') }}
                                </button> -->
                                <button type="submit" class="btn" style="background-color: #7cc404; color: white; font-size:17px;">
                                    {{ __('Se connecter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $("#alerte").fadeTo(2000, 500).slideUp(500, function(){
    $("#alerte").slideUp(500);
});
</script>

@endsection

