@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dodaj temat projektowy') }}</div>

                <div class="card-body">
                    <form method="POST" action="/topics/create">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Tytuł projektu:') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" id="title" type="text" name="title" required autocomplete="title" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Opis projektu:') }}</label>

                            <div class="col-md-6">
                                <textarea style="height:150px" class="form-control" id="description" type="text" name="description" required autocomplete="description" autofocus></textarea>

                            </div>
                        </div>     
                        
                        <div class="form-group row">
                            <label for="technologies" class="col-md-4 col-form-label text-md-right">{{ __('Wymagane technologie:') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" id="technologies" type="text" name="technologies" required autocomplete="technologies" autofocus>

                            </div>
                        </div>                              
                        
                        <div class="form-group row">
                            <label for="difficulty" class="col-md-4 col-form-label text-md-right">{{ __('Trudność:') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" style="Width:100%;" id="difficulty" name="difficulty">
                                    <option value="Niska">Niska</option>
                                    <option value="Średnia">Średnia</option>
                                    <option value="Trudna">Trudna</option>
                                </select>    

                            </div>
                        </div>      


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj projekt') }}
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
