<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use Auth;

class TopicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


//wyświetlenie wszystkich tematów projektowych

    public function index() {

        $topics = Topic::all();


        return view('topic.index', [

            'topics' => $topics,

        ]);
     }


//wyswietlenie pojedynczego projektu

    public function show($id) {

        $users = User::where('reservedTopic', $id)->get();
        $topic = Topic::find($id);

       return view('topic.show', ['topic' => $topic, 'users' => $users]);
    }

//formularz do wypelniania tematu projektu (admin)

    public function create() {

        if(Auth::user()->role != 'admin') return view('home');

        return view('topic.create');
    }


//zapisanie projektu do bazy (admin)

    public function store() {

    if(Auth::user()->role != 'admin') return view('home');

    $topic = new Topic();
    $topic -> title = request('title');
    $topic -> description = request('description');
    $topic -> technologies = request('technologies');
    $topic -> difficulty = request('difficulty');

    $topic -> save();

     return redirect('/topics')->with('message', 'Pomyślnie dodano projekt do bazy!');   
    

    }

//edycja tematu - widok (admin)

    public function edit($id) {
      
        if(Auth::user()->role != 'admin') return view('home');



        $topic = Topic::find($id);


       return view('topic.edit', ['topic' => $topic]);
    }    


//edycja tematu - funkcja (admin)

    public function update ($id) {

       if(Auth::user()->role != 'admin') return view('home');

       $topic = Topic::find($id);
       $topic -> title = request('title');
       $topic -> description = request('description');
       $topic -> technologies = request('technologies');
       $topic -> difficulty = request('difficulty');
       $topic -> save();


       return redirect('/topics')->with('message', 'Pomyślnie edytowano temat'); 
    }    


//usuniecie projektu z bazy (admin)
    
    public function destroy($id) {

        if(Auth::user()->role != 'admin') return view('home');

        $topic = Topic::findOrFail($id);
        $topic -> delete();

         return redirect('/topics')->with('message', 'Pomyślnie usunięto temat!');   
        
    } 



//usuniecie wybranego tematu przez studenta

    public function chooseAnother() {

        $user = User::findOrFail(request('user_id'));
        $user -> reservedTopic = NULL;
        $user -> save();
        
         return redirect('/topics')->with('message', 'Usunięto temat. Proszę wybrać inny.');   
        
    } 

//wybranie tematu projektowego przez studenta
    public function choose() {
            
            $user = User::findOrFail(request('user_id'));
            $user -> reservedTopic = request('topic_id');
            $user -> save();

            return redirect('/topics')->with('message', 'Pomyślnie wybrano temat!');   
            
            } 

//panel z wybranym projektem

    public function myproject() {

       $topic = Topic::find(Auth::user()->reservedTopic);

       return view('topic.myproject', ['topic' => $topic]);
    }


}
