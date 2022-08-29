@extends('layouts.app')


@section('content')
    <div class="container mt-5 col-md-4">
        <a href="{{ route('events.index') }}" class="btn btn-primary">Back</a>

        <h1>{{$event->title}}</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dates_arr as $val)
                        <tr>
                            <td>{{$val['date']}}</td>
                            <td>{{$val['day']}}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>

        Total event {{count($dates_arr)}}

    </div>
@endsection
