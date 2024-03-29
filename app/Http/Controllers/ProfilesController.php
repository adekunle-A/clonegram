<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //

    public function index(User $user)
    {
    
        //check to see if user follows a particular profile
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
         
        // $user = User::findOrFail($user);

        // return view('profiles.index',[
        //     'user' => $user, $follows 
        // ]);

        //for caching to update count at a particular interval
        // $postCount = Cache::remember(
        //     'count.post.' + $user->id, 
        //     now()->addSecounds(30), 
        //     function() use($user){
        //         return $user->posts->count();

        //     });

        return view('profiles.index', compact('user','follows'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'Image' => '',

        ]);
      
    
        if(request('image')){
                $imagePath = request('image')->store('profile','public');
                $image =Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
                $image->save();

                $imageArray = ['image'=> $imagePath];
        }
     
         auth()->user()->profile->update(array_merge( $data,$imageArray ?? []));
        return redirect("/profile/{$user->id}");
        //dd($data);
       // return view('profiles.update',compact('user'));
    }
}
