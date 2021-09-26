@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edytuj temat projektowy') }}</div>

                <div class="card-body">
                    <form method="POST" action="/topics/{{$topic -> id}}/edit">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Tytuł projektu:') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" id="title" type="text" name="title" required autocomplete="title" autofocus value="{{$topic -> title}}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Opis projektu:') }}</label>

                            <div class="col-md-6">
                                <textarea style="height:150px" class="form-control" id="description" name="description" required autocomplete="description" autofocus>{{$topic -> description}}</textarea>

                            </div>
                        </div>     
                        
                        <div class="form-group row">
                            <label for="technologies" class="col-md-4 col-form-label text-md-right">{{ __('Wymagane technologie:') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" id="technologies" type="text" name="technologies" required autocomplete="technologies" autofocus value="{{$topic -> technologies}}">

                            </div>
                        </div>                              
                        
                        <div class="form-group row">
                            <label for="difficulty" class="col-md-4 col-form-label text-md-right">{{ __('Trudność:') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" style="Width:100%;" id="difficulty" name="difficulty">
                                    <option @if ($topic -> difficulty == 'Niska') selected @endif value="Niska">Niska</option>
                                    <option @if ($topic -> difficulty == 'Średnia') selected @endif value="Średnia">Średnia</option>
                                    <option @if ($topic -> difficulty == 'Trudna') selected @endif value="Trudna">Trudna</option>
                                </select>    

                            </div>
                        </div>      


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edytuj projekt') }}
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
