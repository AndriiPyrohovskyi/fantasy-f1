<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::with(['user', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt ?: substr(strip_tags($request->content), 0, 200),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Пост створено успішно!');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500'
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt ?: substr(strip_tags($request->content), 0, 200)
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Пост оновлено успішно!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост видалено успішно!');
    }

    public function toggleLike(Post $post)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Необхідна авторизація'], 401);
        }

        $like = Like::where('user_id', Auth::id())
                   ->where('post_id', $post->id)
                   ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
            $liked = true;
        }

        $post->updateCounts();
        
        if ($liked) {
            $post->user->updateKarma();
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->fresh()->likes_count
        ]);
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        $post->updateCounts();

        return redirect()->route('posts.show', $post)->with('success', 'Коментар додано!');
    }
}

