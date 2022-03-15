<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkHoursRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'week_day' => 'required|integer|min:1|max:7',
            'open_time' => 'date_format:H:i',
            'close_time' => 'date_format:H:i',
            'lanch_time_start' => 'date_format:H:i',
            'lanch_time_end' => 'date_format:H:i'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            "week_day.required" => "Please provide week day",
            "week_day.integer" => "Week day should be integer",
            "open_time.date_format" => "Openning time should be in format 00:00",
            "close_time.date_format" => "Closing time should be in format 00:00",
            "lanch_time_start.date_format" => "Lanch time start should be in format 00:00",
            "lanch_time_end.date_format" => "Lanch time end should be in format 00:00",
        ];
    }
}
