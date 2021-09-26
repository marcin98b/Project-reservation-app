@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-header">
                    @if(Auth::user()->role == 'student')
                        Wybór tematu projektowego
                    @else
                        Zarządzanie projektami
                    @endif 
                </div>

                <div class="card-body">
                    
                    @if (Session::has('message'))
                     <div class="alert alert-success" role="alert"> {{session('message')}}</div>
                    @endif

                    

                    @if(Auth::user()->reservedTopic != NULL && Auth::user()->role == 'student')
                        <div class="alert alert-info"> 
                            Twój wybrany temat:
                            <a href="topics/myproject" >
                                {{$topics->find(Auth::user()->reservedTopic)->title ?? ' wybierz temat'}}
                            </a>
                         @if((Auth::user()->mark->mark ?? '') != NULL) <br/> <b>Wystawiono ocenę, zajrzyj w zakładkę "Mój projekt"!</b> @endif
                        </div>
                    @endif

                    <p>Dostępne tematy:</p>

                    @foreach ($topics as $topic)
                        <div>
                            <a href="./topics/{{$topic-> id}}">
                               {{$loop -> iteration}}. {{$topic -> title }} 
                               @if(Auth::user()->reservedTopic != NULL && Auth::user()->role == 'student' && Auth::user()->reservedTopic == $topic -> id)
                                    <b>(Wybrany projekt)</b>
                               @endif
                            </a>
                            <br/>
                            <p class="text-muted"> {{$topic -> description}} </p>

                     
                        </div>
                    @endforeach
                    
                    
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
