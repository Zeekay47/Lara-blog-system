<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the posts with optional search.
     */
    public function index(Request $request)
    {
        $query = Post::with('user')->latest();
        
        // Apply search if query exists
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $posts = $query->paginate(9)->withQueryString(); // Keep search query in pagination links
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Display user's posts.
     */
    public function myPosts(Request $request)
    {
        $query = Post::where('user_id', Auth::id())->latest();
        
        // Apply search if query exists
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $posts = $query->paginate(9)->withQueryString();

        return view('posts.my', compact('posts'));
    }

    /**
     * Display dashboard with user's stats.
     */
    public function dashboard()
    {
        $myPosts = Post::where('user_id', Auth::id())
                        ->latest()
                        ->take(6)
                        ->get();

        $myTotalPosts = Post::where('user_id', Auth::id())->count();

        $latestPost = Post::where('user_id', Auth::id())
                            ->latest()
                            ->first();

        return view('dashboard', compact(
            'myPosts',
            'myTotalPosts',
            'latestPost'
        ));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.index')
                        ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
        
    /**
     * Show the form for editing the specified post.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.show', $post->id)
                        ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully!');
    }
}