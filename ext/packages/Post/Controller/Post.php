<?php

namespace App\Custom\Post\Controller;
use DB;
use Auth;
use Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Post{


    public function __construct(){}

    public function index(){
        $posts = kmodel('post')::latest()->paginate(15);
        return view('custom.post.index',['posts' => $posts]);
    }

    public function show($id)
    {
      $post = kmodel('post')::find($id);
      $latests = kmodel('post')::latest()->where('id','!=',$id)->take(3)->get();
      $comments = kmodel('comment')::where('post_id', $id)->get();
      return view("custom.post.show",['post'=>$post,'latests'=>$latests,'comments'=>$comments]);
    }

    public function create()
    {
        $id = request('id');
        $post = kmodel('Post')::find($id);
        if(!$post) $post = kmodel('Post')::make();
        return view("custom.post.create",['post'=>$post]);
    }

    public function store()
    {


       request()->validate([
        'title' => 'required',
        'body' => 'required',
        'image' => 'required|mimes:jpg,png,jpeg|max:5048'

    ]);

    $kpost = kmodel('post');

  //   $slug = SlugService::createSlug(\App\Models\post::class, 'slug', request('title'));
  //   return $slug;
  //  $storagePath = Storage::disk('local')->put('public',request('image'));
  //  $img ='public/'.basename($storagePath);

  $uploadfile=Request::file('image');

  $imagearr=[];
  $imagearr[]=[
    'file',
    $uploadfile->path(),
    $uploadfile->getClientOriginalName(),
    $uploadfile->getClientMimeType(),
  ];

    $post = $kpost::create([
    'title' => request('title'),
    'body' => request('body'),
    'user_id' => auth()->user()->id
   ]);



  $post->saveData(['image'=>$imagearr]);

return redirect('/post')
    ->with('message', 'Your post has been added!');

    }

    public function edit($id)
    {

      return view('custom.post.edit')
      ->with('post',kmodel('post')::find($id));

    }

    public function update($id)
    {
    	$Post = kmodel('post')::find($id);
    	$Post->title = request('title');
    	$Post->body  = request('body');
    	$Post->save();

      return redirect('/post/'.$id)
      ->with('message', 'Your post has been updated!');

    }

    public function destroy($id)
    {
      $obj = Kmodel('post')::where('id',$id)->first();
      if($obj) $obj->delete();
   	  return redirect('/post');

    }


}