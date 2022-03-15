<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_day',
        'open_time',
        'close_time',
        'lanch_time_start',
        'lanch_time_end'
    ];

    protected function getOpenTimeAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    protected function getCloseTimeAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    protected function getLanchTimeStartAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    protected function getLanchTimeEndAttribute($value)
    {
        return date('H:i', strtotime($value));
    }
}
