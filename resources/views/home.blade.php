@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-header">{{ __('Wybór tematu projektowego') }}</div>

                <div class="card-body">

                @guest
                    <h2>Panel wyboru projektów zaliczeniowych</h2>
                    <p>
                        Aby uzyskać dostęp do panelu wyboru projektów, należy się <a href="./login">zalogować</a>. <br/>
                        Jeśli nie posiadasz konta w systemie, <a href="./register">zarejestruj się</a>.
                    </p>
                        
             
                @else

                <script>
                     window.location.href = '{{route("topic")}}'; 
                </script>


                @endguest
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
