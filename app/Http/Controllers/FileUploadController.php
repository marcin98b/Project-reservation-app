<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Topic;
use App\Models\User;
use Auth;

class FileUploadController extends Controller
{

    public function show() {

        if(Auth::user()->reservedTopic == NULL) return view('topics');
        $topic = Topic::find(Auth::user()->reservedTopic); 
        $files = User::find(Auth::user()->id)->files;

        return view('topic.myproject_upload',
            ['topic' => $topic],
            ['files' => $files]
        );


    }

    public function fileUpload(Request $req){


        $req->validate([
        'file' => 'required|mimes:zip,rar,7z,tar|max:102400'
        ]);

        $fileModel = new File;

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->user_id = request("user_id");
            $fileModel->save();

            return back()->with('success','Plik został pomyślnie wysłany.')->with('file', $fileName);
        }

    }
}
