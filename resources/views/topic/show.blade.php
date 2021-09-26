@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-header">{{ __('Temat projektowy') }}</div>

                <div class="card-body">

               

               <h2 style="text-align:center;"> {{$topic -> title }} </h2> 
               <hr>
                <p>
                    <b>Opis:</b> <br/>
                     {{$topic -> description}} 
                </p>
                <p>
                    <b>Wykorzystywana technologia:</b> <br/>
                     {{$topic -> technologies}} 
                </p>
                <p>
                    <b>Poziom trudności:</b> <br/>
                     {{$topic -> difficulty}} 
                </p>

                <hr>

                @if(Auth::user()->role === 'admin')
                    Studenci wykonujący ten projekt:
                    @if(!$users->isEmpty())
                    <ol>
                        @foreach($users as $user)
                        <li>{{$user->name}}</li>
                        @endforeach
                    </ol>
                    @else <br/> <b>BRAK</b>
                    @endif
                @endif


                <div class="btnsShow">
                    <button class="btn btn-primary"><a href="{{route("topic")}}">Powrót</a></button>
                    
                
                    @if (Auth::user()->role === 'admin')
                     
                        <button style="display:inline" class="btn btn-secondary">
                            <a href="{{route('topicEdit', $topic -> id)}}">Edytuj temat</a>
                        </button>
                    
                        <form style="margin:0px; padding:0px; display:inline;" action="/topics/{{$topic -> id}}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button style="display:inline" onclick="return confirm('Potwierdź usunięcie projektu')" class="btn btn-danger">
                                    Usuń temat
                                </button>
                        </form>


                    @else
                        @if(Auth::user()->reservedTopic != $topic -> id)
                         
                            @if((Auth::user()->mark->mark ?? '') == NULL && (Auth::user()->files->count() == 0)) 
                            <form style="margin:0px; padding:0px; display:inline;" action="{{route('topicChoose')}}" method="POST">
                                @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="topic_id" value="{{$topic -> id}}">
                                    <button style="display:inline" onclick="return confirm('Potwierdź wybór projektu')" class="btn btn-success">
                                        Wybierz temat
                                    </button>
                            </form>
                            @endif
                        @else 
                                 <button style="display:inline" class="btn btn-success" disabled>Ten temat jest przez ciebie wybrany</button>
                        @endif 

                    @endif


                </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
