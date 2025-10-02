<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(User $user = null)
    {
        $user = $user ?: Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $posts = $user->posts()->paginate(5);
        
        return view('users.profile', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio
        ];

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        if ($request->password) {
            $request->validate(['password' => 'min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.profile')->with('success', 'Профіль оновлено успішно!');
    }

    public function destroy(User $user)
    {
        if ($user->id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $user->delete();
        
        if ($user->id === Auth::id()) {
            Auth::logout();
            return redirect()->route('home')->with('success', 'Акаунт видалено успішно!');
        }

        return redirect()->route('leaderboard')->with('success', 'Користувача видалено успішно!');
    }

    public function leaderboard()
    {
        $users = User::orderBy('karma', 'desc')
                    ->take(50)
                    ->get();
        
        return view('users.leaderboard', compact('users'));
    }
}
