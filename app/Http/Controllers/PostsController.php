<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $users= auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);
   
        //return view('posts.index');

        return view('posts.index', compact('posts'));
    }
    public function create(){

        return view ('posts.create');
    }

    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);
        $imagePath = request('image')->store('upload','public');
        $image =Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' =>  $imagePath,
        ]);
        //redirect

        return redirect('/profile/' . auth()->user()->id);
       // \APP\Models\Post::create($data);
        dd(request()->all());

       // return view ('posts.store');
    }
    public function show(\App\Models\Post $post){
        //dd($post);
        return view ('posts.show',compact('post'));
    }
}
