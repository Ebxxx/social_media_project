<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class PostController extends Controller
{
    // Fetch all posts with their associated user and comments
    public function index()
    {
        $posts = Post::with('user')->withCount('like')->with('comments')->latest()->get();
        return response()->json($posts);
        // $posts = Post::with(['user', 'comments'])->latest()->get();
        // return response()->json($posts);
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post = Post::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return response()->json($post, 201);
    }

    // // Like a post
    // public function like(Post $post)
    // {
    //     // Increment the like count
    //     $post->like_count++;
    //     $post->save();

    //     return response()->json(['message' => 'Post liked successfully', 'likes_count' => $post->like_count]);
    // }

    // public function like(Post $post)
    // {
    //     // Create a new Like instance
    //     $like = new Like();
    //     $like->user_id = auth()->id();
    //     $like->post_id = $post->id;
    //     $like->save();

    //     // Increment the like count (optional)
    //     $post->like_count++;
    //     $post->save();

    //     return response()->json(['message' => 'Post liked successfully', 'likes_count' => $post->like_count]);
    // }

    public function toggleLike(Post $post)
    {
        // Check if the user has already liked the post
        $like = Like::where('user_id', auth()->id())->where('post_id', $post->id)->first();

        if ($like) {
            // If already liked, delete the like (unlike)
            $like->delete();
            $post->like_count--;
            $post->save();

            return response()->json(['message' => 'Post unliked', 'liked' => false, 'like_count' => $post->like_count]);
        } else {
            // If not liked yet, add a like
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
            ]);
            $post->like_count++;
            $post->save();

            return response()->json(['message' => 'Post liked', 'liked' => true, 'like_count' => $post->like_count]);
        }
    }

    // public function toggleLike(Post $post) {
    //     // Check if the user has already liked the post
    //     $like = Like::where('user_id', auth()->id())
    //                 ->where('post_id', $post->id)
    //                 ->first();

    //     if ($like) {
    //         // Unlike if the post is already liked by the user
    //         $like->delete();
    //         $post->like_count--; // Decrement like count
    //         $post->save();

    //         return response()->json(['message' => 'Post unliked', 'liked' => false]);
    //     } else {
    //         // Like if it is not yet liked by the user
    //         Like::create([
    //             'user_id' => auth()->id(),
    //             'post_id' => $post->id
    //         ]);

    //         $post->like_count++; // Increment like count
    //         $post->save();

    //         return response()->json(['message' => 'Post liked', 'liked' => true]);
    //     }
    // }

    // Add a comment to a post
    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return response()->json($comment, 201);
    }
}
