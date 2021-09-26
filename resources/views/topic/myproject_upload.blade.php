@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-header">{{ __('Wysyłanie projektu') }}</div>

                <div class="card-body">
               
                    <h3 class="text-center mb-3">Upload Center</h3>
                    <p>
                    Wyślij swój projekt pt. <b>"{{$topic->title}}"</b> w archiwum (.zip, .rar, .7z, .tar) o maksymalnej wielkości 100 MB. <br/>
                    Dozwolone jest 3-krotne wysłanie archiwów w ramach poprawy oceny. <br/>

                    <h5 style="color:red">Jeśli wyślesz swoje pierwsze archiwum zmiana tematu nie będzie możliwa!</h5>
                   </p>      
               
                    <b>Twoje przesłane pliki ({{Auth::user()->files->count()}}/3 możliwych prób):</b>
                    <ul>
                        @foreach ($files as $file)
                             <li class="small text-muted"><a href="{{asset($file->file_path)}}"> {{$file->name}} </a></li>
                        @endforeach  
                    </ul>
                    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">

                          @csrf
                          @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                              <strong>{{ $message }}</strong>
                          </div>
                        @endif
              
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif

                          <div class="custom-file">
                              <input type="file" name="file" class="custom-file-input" id="chooseFile">
                              <label class="custom-file-label" for="chooseFile">Wybierz plik</label>
                          </div>
                          <div class="btnsShow">
                          <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>

                        <button class="btn btn-primary mt-3"><a href="{{route("topicMyProject")}}">Powrót</a></button>

                        @if(Auth::user()->files->count() != 3)
                          <button class="btn btn-success mt-3" type="submit" name="submit" class="btn btn-primary mt-3">
                              Wyślij projekt
                          </button>
                        @else
                             <button class="btn btn-success mt-3" disabled>3/3 wykorzystane próby</button>    
                        @endif

                        </div>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
