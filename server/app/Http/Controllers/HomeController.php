<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkHoursRequest;
use App\Models\WorkHours;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function isOpened()
    {
        $now = Carbon::now();
        $time = strtotime($now->toTimeString());
        $workingHours = WorkHours::where(['week_day' => $now->dayOfWeek])->select('open_time', 'close_time', 'lanch_time_start', 'lanch_time_end')->first();

        $isOpened = false;
        $willOpen = '';
        $workingToday = false;

        if ($workingHours) {
            if ($time >= strtotime($workingHours->lanch_time_start) && $time <= strtotime($workingHours->lanch_time_end)) {
                $workingToday = true;
                $willOpen = 'After ' . $workingHours->lanch_time_end;
            } elseif ($time >= strtotime($workingHours->open_time) && $time <= strtotime($workingHours->close_time)) {
                $isOpened = true;
            }
        }

        $daysCnt = 0;
        if (!$workingToday) {
            $nextDay = $now->addDay();
            do {
                $workingHours = WorkHours::where(['week_day' => $nextDay->dayOfWeek])->select('open_time', 'close_time', 'lanch_time_start', 'lanch_time_end')->first();
                ++$daysCnt;

                if (!$workingHours) {
                    $nextDay = $nextDay->addDay();
                } else {
                    $willOpen = 'After ' . $daysCnt . ($daysCnt > 1 ? ' days' : ' day') . '. From ' . date('H:i', strtotime($workingHours->open_time)) . ' to ' . date('H:i', strtotime($workingHours->close_time));
                }
            } while (!$workingHours);
        }

        return response()->json(['opened' => $isOpened, 'will_open' => $willOpen]);
    }

    public function checkOpened(WorkHoursRequest $request)
    {
        $workingHours = WorkHours::where(['week_day' => $request->week_day])->select('open_time')->first();
        return response()->json(['opened' => $workingHours ? true : false]);
    }
}
