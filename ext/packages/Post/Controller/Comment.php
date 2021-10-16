<?php

namespace App\Custom\Post\Controller;
use DB;
use Auth;
use Request;

class Comment {

    public function index(){

        
    }

    public function show(){

        
    }

public function update($id)
    {
        request()->validate([
            'comment' => 'required',
        ]);

        $kcomment = kmodel('comment');

         $kcomment::create([
            'comment' => request('comment'),
            'user_id' =>  auth()->user()->id,
            'post_id' => $id,
            'status' => 0
           ]);

           return redirect('/post/'.$id)
          ->with('message', 'Your comment has been added!');

    }


}