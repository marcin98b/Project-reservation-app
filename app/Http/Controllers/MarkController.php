<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Models\Mark;
Use Auth;


class MarkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


//dodawanie i edycja ocen (admin)

    public function markAssign()
    {
        if(Auth::user()->role != 'admin') return view('home');

        $id = request('user_id');
        $user = User::find($id);

        if($user->mark->mark ?? '' != NULL)
        {
            $user->mark->mark = request('mark');
            $user->push();
        }
        else
        {
            $mark = new Mark;
            $mark->mark = request('mark');
            $user->mark()->save($mark);
        }
 
        return redirect('/dashboard')->with('message', 'Pomyślnie edytowano ocenę studentowi '.$user->name.'.'); 
    }
}
