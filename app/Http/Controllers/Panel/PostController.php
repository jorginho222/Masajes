<?php

namespace App\Http\Controllers\Panel;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $userPosts = Post::where('user_id', '=', $request->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

            // dd($userPosts[0]->user->name);
                  
        return view('panel.posts.index')->with([
            'userPosts' => $userPosts
        ]);
    }

    public function create()
    {
        return view('panel.posts.create');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'content' => ['required', 'string', 'max:3000'],
            'published' => ['required'],
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 400,
                'errors'=>$validator->errors()
            ]);
        } 
        else
        {
            return response()->json([
                'status'=> 200,
                'message'=>'Post validado'
            ]);
        }
    }

    public function store(PostRequest $request)
    {
        $user = $request->user();

        $post = $user->posts()->create($request->all());

        if($request->hasFile('image')) {
            $post->image()->create([
                'path' => 'images/' . $request->image->store('posts', 'images')
            ]);
        }

        return redirect()
            ->route('posts.index')
            ->withSuccess("La publicacion se ha creado correctamente");
        
    }

    public function show(Post $post)
    {
        return view('panel.posts.show')->with([
            'post' => $post,
        ]);
    }

    public function edit(Post $post)
    {
        $this->authorize('author', $post);

        return view('panel.posts.edit')->with([
            'post' => $post,
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post);

        $post->update($request->all());

        if ($request->hasFile('image')) {
            if(isset($post->image->path)) {
                $path = storage_path("app/public/{$post->image->path}");
                File::delete($path);
                
                $post->image->delete();
            }
            $post->image()->create([
                'path' => 'images/' . $request->image->store('posts', 'images'),
            ]);
        }

        return redirect()
            ->route('posts.index')
            ->withSuccess("La publicacion con el titulo \"{$post->title}\" ha sido editada.");
    }

    public function destroy(Post $post)
    {
        $this->authorize('author', $post);
        $post->comments()->delete();
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->withSuccess("La publicacion con id {$post->id} fue eliminada correctamente.");
    }
}
