@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/printMarks.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
               
                <div class="card-header">{{ __('Panel administracyjny') }}</div>

                <div class="card-body">
                
                    @if (Session::has('message'))
                    <div class="alert alert-success" role="alert"> {{session('message')}}</div>
                   @endif

                    <p>Wykaz ocen studentów:</p>
                    <div class="table-responsive">
                    <table id="marksTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Imię i nazwisko</th>
                              <th scope="col">Indeks</th>
                              <th scope="col">Temat projektowy</th>
                              <th scope="col">Przesłane pliki</th>
                              <th scope="col">Ocena</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td scope="row"> {{$loop -> iteration}}</td>
                                    <td> {{$user -> name}} </td>
                                    <td> {{$user -> index}} </td>
                                    <td> {{$topics->find($user->reservedTopic)->title ?? '-'}}</td>
                                    <td>
                                        <ol style="padding-left:10px">
                                        @foreach($user->files as $file)
                                                <li class="small text-muted"><a href="{{asset($file->file_path)}}"> {{$file->name}} ({{$file->created_at}})</a></li>
                                        @endforeach
                                        </ol>
                                    </td>
                                    <td> 
                                        {{$user->mark->mark ?? '-'}}
                                     
                                     @if($user->reservedTopic ?? '')
                                        &nbsp; <input type="checkbox" onclick="check()" class="check"/>
                                       <div class="editRadio"> @if($user->mark->mark ?? '' && $user->reservedTopic) Edytuj @else Wystaw @endif </div>
                                            <div class="checkForm">
                                                <form method="POST" action="{{route('markAssign')}}">
                                                    @csrf
                                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                                <select class="" id="mark" name="mark">
                                                    <option @if(($user->mark->mark ?? '-') == '2.0') disabled @endif value="2.0">2.0</option>                                           
                                                    <option @if(($user->mark->mark ?? '-') == '3.0') disabled @endif value="3.0">3.0</option>
                                                    <option @if(($user->mark->mark ?? '-') == '3.5') disabled @endif value="3.5">3.5</option>
                                                    <option @if(($user->mark->mark ?? '-') == '4.0') disabled @endif value="4.0">4.0</option>
                                                    <option @if(($user->mark->mark ?? '-') == '4.5') disabled @endif value="4.5">4.5</option>
                                                    <option @if(($user->mark->mark ?? '-') == '5.0') disabled @endif value="5.0">5.0</option>
                                                </select> 
                                                <input type="submit"/>
                                            </form> 
                                            </div>
                                    @endif
                                    </td>

                                </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
                <div class="btnsShow">
                    <button style="display:inline" class="btn btn-secondary">
                        <a href="{{route('exportJSON')}}">Eksport JSON</a>
                    </button>
                    <button style="display:inline" class="btn btn-secondary" onclick="window.print(); return false;">
                        Drukuj
                    </button>

                </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>

//Panel edytowania ocen

var el = document.getElementsByClassName('checkForm');
for (var i=0;i<el.length; i++) {
    el[i].style.visibility="hidden";
}

function check(){

let check = document.getElementsByClassName('check');
for (var i=0;i<check.length; i++) {

if(check[i].checked)
    {
        el[i].style.visibility="visible";
    }
else el[i].style.visibility="hidden";

}

}

</script>
@endsection
