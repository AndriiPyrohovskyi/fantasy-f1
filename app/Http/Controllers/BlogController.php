<?php

namespace App\Http\Controllers;

class BlogController extends Controller {
    public function posts($posts){
        return view('blog.posts', [
            'title' => 'Posts',
            'posts' => $posts
        ]);
    }
    public function leaderboard($leaderboard){
        return view('blog.leaderboard', [
            'title' => 'Carma Leaderboard',
            'users' => $leaderboard
        ]);
    }
    public function profile($user){
        return view('blog.profile', [
            'title' => 'Profile',
            'user' => $user
        ]);
    }
    public function auth(){
        return view('blog.auth', [
            'title' => 'Authorization'
        ]);
    }
}

