<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Course;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index()
    {
        $onlyThreePosts = Post::latest()
            ->where('published', '=', '1')
            ->take(3)
            ->get();

        return view('main.welcome')->with([
            'onlyThreePosts' => $onlyThreePosts,
            'services' => Service::all(),
        ]);
    }

    public function blog()
    {
        $posts = Post::latest()
            ->where('published', '=', '1')
            ->get();

        return view('main.blog')->with([
            'posts' => $posts,
        ]);
    }

    public function post(Post $post)
    {
        $this->authorize('published', $post);

        $somePosts = Post::latest()
            ->where('published', '=', '1')
            ->take(5)
            ->get();

        return view('main.post')->with([
            'post' => $post,
            'comments' => $post->comments,
            'somePosts' => $somePosts,
        ]);
    }

    public function contact()
    {
        return view('main.contact');
    }

    public function courses()
    {
        $courses = Cache::remember('courses', 30, function () {
            return Course::all();
        });

        return view('main.courses')->with([
            'courses' => $courses,
        ]);
    }

    public function course(Course $course)
    {
        return view('main.course')->with([
            'course' => $course,
        ]);
    }
}
