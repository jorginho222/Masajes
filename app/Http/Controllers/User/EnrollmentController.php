<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class EnrollmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.enrollments.index')->with([
            'courses' => $user->courses]);
    }

    public function start(Course $course)
    {
        // $courses = Cache::remember('courses', 3600, function () {
        //     return Course::all();
        // });

        // dd($course);
        
        return view('user.enrollments.create')->with([
            'course' => $course,
            'user' => Auth::user(),
        ]); 
    }
}
