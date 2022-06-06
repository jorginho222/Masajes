<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
            'image' => ['nullable', 'image'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $initDay = Carbon::parse($this->init_date)->englishDayOfWeek;
            
            if($this->finish_time <= $this->init_time) {
                $validator->errors()->add('finish_time', 'La hora de finalizacion de cursada debe ser mayor que la de inicio.');
            }

            if($initDay != $this->day) {
                $validator->errors()->add('init_date', 'El dia de inicio del curso debe ser el mismo que los dias de cursada.');
            }
            
        });
    }
}
