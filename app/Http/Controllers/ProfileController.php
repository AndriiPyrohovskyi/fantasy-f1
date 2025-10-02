<?php

namespace App\Http\Controllers;

class ProfileController extends Controller {
    public function add($user){
        return redirect()->route('blog.profile');
    }
    public function edit($user){
        return redirect()->route('blog.profile');
    }
    public function delete($user){
        return redirect()->route('blog.profile');
    }
    public function add_profile(){
        return redirect()->route('blog.auth');
    }
    public function edit_profile($user){
        return view('profile.edit_profile', [
            'title' => 'Edit profile' . $user["username"],
            'user' => $user
        ]);
    }
}

