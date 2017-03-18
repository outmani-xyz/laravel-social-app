<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    public function getDashboard() {
        $posts = Post::orderby('created_at', 'desc')->get();

        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request) {
        $this->validate($request, ['body' => 'required|max:1000']);
        $post = new Post();
        $post->body = $request['body'];
        ($request->user()->posts()->save($post)) ? $message = 'Post Cretated Successfully' : $message = 'Somthing Wrong !';
        return redirect()->route('user.dashboard')->with(['message' => $message]);
    }

    public function postEditPost(Request $request) {
        $post = Post::find($request['post_id']);
        $this->validate($request, ['body' => 'required|max:1000']);
        if ($post) {
            $post->body = $request['body'];
            $post->update();
            return response()->json(['message' => 'Post update successfully', 'body' => $post->body], 200);
        }
    }

    public function getDeletePost($post_id) {
        $post = Post::find($post_id);
        if (Auth::user() == $post->user) {
            $post->delete();
            return redirect()->route('user.dashboard')->with(['message' => 'Post Deleted']);
        }
        return redirect()->route('user.dashboard')->with(['message' => 'Post Not exist']);
    }

    public function postLike(Request $request) {
        try {

            $post_id = $request['post_id'];
            $isLike = $request['isLike'] == 'true';
            $update = false;
            $post = Post::find($post_id);
            if (!$post) {
                return null;
            }
            $user = Auth::user();
            $like = $user->likes()->where('post_id', $post_id)->first();
            if ($like) {
                $like_status = $like->like;
                $update = true;
                if ($like_status == $isLike) {
                    $like->delete();
                    return response()->json([
                                'Likes' => count($post->likes()->where('like', 1)->get()),
                                'Dislikes' => count($post->likes()->where('like', 0)->get()),
                                'status' => null
                                    ], 200);
                }
            } else {
                $like = new Like();
            }
            $like->like = $isLike;
            $like->user_id = $user->id;
            $like->post_id = $post_id;
            if ($update) {
                $like->update();
            } else {
                $like->save();
            }
            return response()->json([
                        'likes' => count($post->likes()->where('like', 1)->get()),
                        'dislikes' => count($post->likes()->where('like', 0)->get()),
                        'status' => Auth::user()->likes()->where('post_id', $post->id)->first()->like
                            ], 200);
        } catch (Exception $ex) {
            return response()->json(['msg' => $ex->message()], 200);
        }
    }

}
