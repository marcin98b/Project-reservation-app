@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-header">{{ __('Twój wybrany projekt') }}</div>

                <div class="card-body">
           

                    @if (Auth::user()->reservedTopic == NULL)
                        <div class="alert alert-danger">Brak wybranego projektu!</div>
                    @else
                        
                        @if($topic != NULL)
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
                        @else
                             <p>Wybrany projekt nie istnieje, być może został usunięty przez administratora. Proszę wybrać nowy temat z listy.</p>
                             @php $notExists = TRUE; @endphp
                        @endif 

                    @endif

                        <hr>

                        @if(Auth::user()->files->count() && (Auth::user()->mark->mark ?? '') == NULL)
                            <div class="alert alert-primary">
                                Archiwum z projektem wysłane. Proszę o cierpliwość, ocena pojawi się wkrótce.
                            </div>
                        @endif

                        @if(Auth::user()->mark->mark ?? '' != NULL)
                            <div class="alert alert-primary">
                                Twoja ocena: <b> {{Auth::user()->mark->mark}} </b>
                            </div>
                        @endif

                        <div class="btnsShow">
                        
                            <button class="btn btn-primary"><a href="{{route("topic")}}">Powrót</a></button>

                            @if(Auth::user()->reservedTopic != NULL)
                             
                               <button class="btn btn-success"><a href="{{route("fileUpload")}}">Upload Center</a></button>


                                @if(isset($notExists))
                                    <form style="margin:0px; padding:0px; display:inline;" action="{{route("topicChooseAnother")}}" method="POST">
                                        @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            <button style="display:inline" onclick="return confirm('Potwierdź rezygnację z projektu. Konieczne jest wybranie innego.')" class="btn btn-danger">
                                                Zrezygnuj z tematu
                                            </button>
                                    </form>
                                @endif


                           @endif
                           


                        </div>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
