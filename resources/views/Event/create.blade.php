@extends('layouts.app')


@section('content')
    <div class="container mt-5 col-md-4">

        <a href="{{route('events.index')}}" class="btn btn-primary">Back</a>

        <form action="{{route('events.store')}}" id="event_add" method="POST">
            @csrf

            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" >
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Start Date</label>
                <input type="date" class="form-control datepicker" name="start_date" >
                @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                 @endif
            </div>
            <div class="form-group">
                <label for="">End Date</label>
                <input type="date" class="form-control datepicker" name="end_date" >
                @if ($errors->has('end_date'))
                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                 @endif
            </div>

            <div class="form-group">
                <label for="">Recurrence</label>
                <select name="recurrence_time">
                    <option selected="selected" value="1">Every</option>
                    <option value="2">Every Other</option>
                    <option value="3">Every Third</option>
                    <option value="4">Every Fourth</option>
                </select>
                <select name="recurrence_duration">
                    <option selected="selected" value="1">Day</option>
                    <option value="2">Week</option>
                    <option value="3">Month</option>
                    <option value="4">Year</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add Event">
            </div>
        </form>

    </div>
@endsection
