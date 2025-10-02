<?php

namespace App\Http\Controllers;

class CommentController extends Controller {
    public function add($comment){
        return redirect()->route('post.view_post');
    }
    public function edit($comment){
        return redirect()->route('blog.profile');
    }
    public function delete($comment){
        return redirect()->route('blog.profile');
    }
    public function add_profile(){
        return redirect()->route('blog.auth');
    }
    public function edit_profile($comment){
        return view('profile.edit_profile', [
            'title' => 'Edit profile' . $comment["commentname"],
            'comment' => $comment
        ]);
    }
}

