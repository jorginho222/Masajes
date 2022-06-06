<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\EnrollmentRequest;
use Illuminate\Support\Facades\Validator;

class EnrollmentOrderController extends Controller
{
    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user()->id),
            ],
            'course_id' => 'required',
            'phone' => ['nullable', 'max:10'],
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()
            ]);
        } else {
            $validator->after(function ($validator) use ($request) {
                $user = $request->user();

                if(isset($user->courses[0])) {
                    $userCourses = $user->courses;
                    foreach ($userCourses as $userCourse) {
                        if ($userCourse->id == $request->course_id) {
                            $validator->errors()->add('course_id', 'Usted ya se encuentra inscripto en este curso.');
                        }
                    }
                }

                $courseCapacity = Course::findOrFail($request->course_id)->capacity;
                if ($courseCapacity == 0) {
                    $validator->errors()->add('course_id', 'No se podra procesar la inscipcion: se ha alcanzado el numero maximo de inscriptos para el curso seleccionado. Sepa disculpar.');
                }
            });
            if($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->errors()
                ]);
            } else {
                return response()->json([
                    'status'=>200,
                    'message'=>'Inscripcion validada'
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $user->fill(array_filter($request->all())); // array_filter(): solo actualizaremos lo q el usuario haya editado

        $user->save();

        $course = Course::findOrFail($request->course_id);

        $order = $course->enrollmentOrders()->create([
            'status' => 'started',
            'user_id' => $user->id,
        ]);

        // dd($order->course);
        // dd($user->enrollmentOrders);

        return redirect()
            ->route('enrollments.orders.payments.create', ['order' => $order]);
    }
}
