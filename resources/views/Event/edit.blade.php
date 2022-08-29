@extends('layouts.app')


@section('content')
    <div class="container mt-5 col-md-4">

        <a href="{{ route('events.index') }}" class="btn btn-primary">Back</a>

        <form action="{{ route('events.update' , $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" value="{{ $event->title }}" name="title" required>
            </div>
            <div class="form-group">
                <label for="">Start Date</label>
                <input type="date" class="form-control datepicker" value="{{ $event->start_date }}" name="start_date"
                    required>
            </div>
            <div class="form-group">
                <label for="">End Date</label>
                <input type="date" class="form-control datepicker" value="{{ $event->end_date }}" name="end_date"
                    required>
            </div>

            <div class="form-group">
                <label for="">Recurrence</label>
                <select name="recurrence_time">
                    <option value="1" {{ $event->recurrence_time == 1 ? 'selected' : '' }}>Every</option>
                    <option value="2" {{ $event->recurrence_time == 2 ? 'selected' : '' }}>Every Other</option>
                    <option value="3" {{ $event->recurrence_time == 3 ? 'selected' : '' }}>Every Third</option>
                    <option value="4" {{ $event->recurrence_time == 4 ? 'selected' : '' }}>Every Fourth</option>
                </select>
                <select name="recurrence_duration">
                    <option value="1" {{ $event->recurrence_duration == 1 ? 'selected' : '' }}>Day</option>
                    <option value="2" {{ $event->recurrence_duration == 2 ? 'selected' : '' }}>Week</option>
                    <option value="3" {{ $event->recurrence_duration == 3 ? 'selected' : '' }}>Month</option>
                    <option value="4" {{ $event->recurrence_duration == 4 ? 'selected' : '' }}>Year</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Update Event">
            </div>
        </form>

    </div>
@endsection
