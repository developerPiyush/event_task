@extends('layouts.app')
@section('content')
    <div class="container mt-5 col-md-8">

        <a href="{{ route('events.create') }}" class="btn btn-primary float-right mb-5">Add Event</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Dates</th>
                    <th scope="col">Occurrence</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @isset($events)
                @foreach ($events as $event)
                @php
                $i = 1;
                @endphp
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $event->title }}</td>
                    <td>{{ Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} to
                        {{ Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }} </td>
                    <td>{{ $event->week . ' ' . $event->duration}}</td>
                    <td>
                        <a href="{{route('events.show',$event->id)}}" class="btn btn-primary">View</a>
                    </td>
                    <td>
                        <a href="{{route('events.edit',$event->id)}}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('events.destroy',$event->id)}}" method="POST">
                         @csrf
                         @method('DELETE')
                         <input type="submit" onclick="return confirm('Are you sure?')" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
                @endforeach
                @endisset



            </tbody>
        </table>
    </div>
@endsection
