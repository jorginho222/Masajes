<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'service_id' => 'required',
            'quantity' => 'required',
            'date' => 'required',
            'time' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $requestDay = Carbon::parse($this->date)->englishDayOfWeek;

            if($requestDay == 'Sunday') {
                $validator->errors()->add('date', 'Elija un dia de lunes a sabado de 9 a 17 hs');
            }

            // $booking = Booking::make();
            // $time = Carbon::parse($this->time)->format('H:i:s');

            // $available = $booking->getAvailability($this->date, $time);

            // if(!$available) {
            //     $validator->errors()->add('time', 'Nos encontramos sin disponibilidad para la fecha y hora seleccionadas.');
            // }

        });
    }
}
