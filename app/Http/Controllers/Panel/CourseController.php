<?php

namespace App\Http\Controllers\Panel;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        return view('panel.courses.index')->with([
            'courses' => Course::all(),
        ]);
    }

    public function create()
    {
        return view('panel.courses.create');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'day' => 'required',
            'init_time' => 'required',
            'finish_time' => 'required',
            'init_date' => 'required',
            'duration' => ['required', 'min:1'],
            'capacity' => ['required', 'min:1'],
            'fee' => ['required', 'min:1'],
            'enrollment' => ['required', 'min:1'],
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=>$validator->errors()
            ]);
        } else {
            $validator->after(function ($validator) use ($request) {
                $initDay = Carbon::parse($request->init_date)->englishDayOfWeek;
                $init_time = Carbon::parse($request->init_time)->format('H:i:s');
                $finish_time = Carbon::parse($request->finish_time)->format('H:i:s');
                
                if($initDay != $request->day) {
                    $validator->errors()->add('init_date', 'El dia de inicio del curso debe ser el mismo que los dias de cursada.');
                }
                if($finish_time <= $init_time) {
                    $validator->errors()->add('finish_time', 'La hora de finalizacion de cursada debe ser mayor que la de inicio.');
                }
            });

            if($validator->fails()) {
                return response()->json([
                    'status'=> 400,
                    'errors'=>$validator->errors()
                ]);
            } else {
                return response()->json([
                    'status'=> 200,
                    'message'=>'Servicio validado'
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        Carbon::parse($request->init_time)->format('H:i:s');
        Carbon::parse($request->finish_time)->format('H:i:s');
 
        $course = Course::create($request->all());
        
        if($request->hasFile('image')) {
            $course->image()->create([
                'path' => 'images/' . $request->image->store('courses', 'images'),
            ]);
        }

        return redirect()
            ->route('courses.index')
            ->withSuccess('El curso se ha creado correctamente.');
    }

    public function showEnrolledUsers(Course $course)
    {
        if(isset($course->users[0]))
        {
            return response()->json([
                'status'=>200,
                'enrolledUsers'=> $course->users,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Enrolled Users Found.'
            ]);
        }
    }

    public function edit(Course $course)
    {
        return view('panel.courses.edit')->with([
            'course' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());

        if ($request->hasFile('image')) {
            $path = storage_path("app/public/{$course->image->path}");
            File::delete($path);
            
            $course->image->delete();
            
            $course->image()->create([
                'path' => 'images/' . $request->image->store('courses', 'images'),
            ]);
        }

        return redirect()
            ->route('courses.index')
            ->withSuccess("El curso con el id {$course->id} se actualizó correctamente.");
        }

    public function destroy(Course $course)
    {
        $course->enrollmentOrders()->delete();
        $course->users()->detach();
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->withSuccess("El curso con id {$course->id} se eliminó correctamente.");
    }
}
