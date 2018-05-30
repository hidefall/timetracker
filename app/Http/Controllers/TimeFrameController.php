<?php

namespace App\Http\Controllers;

use App\Models\TimeFrame;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeFrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function start(Request $request){
        return TimeFrame::create([
            'user_id'=>auth()->user()->id,
            'timer_started'=>Carbon::now()->timestamp
        ]);
    }

    public function stop(TimeFrame $timeFrame){
        $timeFrame->timer_finished = Carbon::now()->timestamp;
        if($timeFrame->save()){
            return $timeFrame;
        }
    }

    public function updateTimer(Request $request){
//        dd($request->input());
        $request->request->add([
            'timeframe'=>$request->timeframe['id'],
            'project'=>$request->form['project'],
            'task'=>$request->form['task'],
            'description'=>$request->form['description'],
            'billable'=>$request->form['billable'],
            'price_per_hour'=>$request->form['price_per_hour']
        ]);

        $request->validate([
            'timeframe'=>'required|integer',
            'project'=>'nullable|integer',
            'task'=>'nullable|integer',
            'description'=>'nullable|string',
            'billable'=>'nullable|boolean',
            'price_per_hour'=>'nullable|integer'
        ]);

        $tf = TimeFrame::find($request->timeframe);
        $tf->task_id = $request->task;
        $tf->description = $request->description;
        $tf->billable = $request->billable ? '1' : '0';
        $tf->price_per_hour = $request->price_per_hour;

        if($tf->save()){
            return $tf;
        }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TimeFrame  $timeFrame
     * @return \Illuminate\Http\Response
     */
    public function show(TimeFrame $timeFrame)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimeFrame  $timeFrame
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeFrame $timeFrame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeFrame  $timeFrame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeFrame $timeFrame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeFrame  $timeFrame
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeFrame $timeFrame)
    {
        //
    }
}
