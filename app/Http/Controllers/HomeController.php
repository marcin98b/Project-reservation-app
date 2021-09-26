<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Models\File;
Use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /**
     * 
     * Admin dashboard
     * 
     */
    public function dashboard()
    {
        if(Auth::user()->role != 'admin') return view('home');

        $topics = Topic::all();
        $users = User::all()->except(Auth::id());

        return view('admin.dashboard', [
            'users' => $users,
            'topics' => $topics

        ]);
    }

    //eksport JSON ocen (admin)
    
    public function exportJSON()
    {
        if(Auth::user()->role != 'admin') return view('home');

        $users = User::select('id','name', 'index')->where('id', '!=', Auth::user()->id)->with('mark')->get();
        return $users->toJson(JSON_PRETTY_PRINT);

    }


}
