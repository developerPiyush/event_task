<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();
        return view('Event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string'],
            'start_date' => 'required',
            'end_date' => 'required',
            'recurrence_time' => 'required',
            'recurrence_duration' => 'required',
          ]);

        $event = new Event();
        $event->title = $request->title;
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
        $event->recurrence_time = $request->recurrence_time;
        $event->recurrence_duration = $request->recurrence_duration;
        $event->recurrence_day = today();
        $event->save();


        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        $date_interval_string  = strtolower($event->week);

        $start_date = new DateTime($event->start_date);
        $end_date = new DateTime($event->end_date);

        $interval = DateInterval::createFromDateString("$event->week  $event->duration");


        $period = new DatePeriod($start_date, $interval, $end_date);

        $dates_arr = [];

        foreach ($period as $key => $val) {
            if ($key == 0) {
                $first_date_of_the_month = new Carbon($val->format('d-m-Y'));
                $month = $first_date_of_the_month->startOfMonth()->format('M');
                $year = $first_date_of_the_month->startOfMonth()->format('Y');

                $day_of_month = cal_days_in_month(CAL_GREGORIAN, date("n", strtotime($month)), $year);


                $first_date = $year . '-' . date("n", strtotime($month)) . '-' . $day_of_month;
                $second_date = strtotime($event->start_date);

                $finalDate  =  strtotime($first_date);
                if (strtotime($first_date) > $second_date) {
                    $dates_arr[$key]['date'] =  $first_date;
                    $dates_arr[$key]['day'] =  date("D", strtotime($finalDate));
                }

                continue;
            }

            $dates_arr[$key]['date'] = $val->format('Y-m-d');
            $dates_arr[$key]['day'] =  $val->format('D');
        }



        return view('Event.show', compact('event', 'dates_arr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('Event.edit', compact('event'));
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

        $event = Event::find($id);
        $event->title = $request->title;
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
        $event->recurrence_time = $request->recurrence_time;
        $event->recurrence_duration = $request->recurrence_duration;
        $event->recurrence_day = today();
        $event->save();

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect(route('events.index'));
    }
}
