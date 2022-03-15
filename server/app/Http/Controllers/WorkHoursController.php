<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkHoursRequest;
use App\Models\WorkHours;
use Illuminate\Http\Request;

class WorkHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WorkHours::orderBy('week_day')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WorkHoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkHoursRequest $request)
    {
        $workHour = WorkHours::updateOrCreate(
            ['week_day' =>  $request->week_day],
            [
                'open_time' => $request->open_time,
                'close_time' => $request->close_time,
                'lanch_time_start' => $request->lanch_time_start,
                'lanch_time_end' => $request->lanch_time_end,
            ]
        );

        return $workHour;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
