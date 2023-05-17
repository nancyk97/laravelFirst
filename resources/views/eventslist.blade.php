@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Event View</h1>

    <div class="ms-auto">
        {{-- Add button to create a new event --}}
        <a href="{{ route('eventsCreation') }}" class="btn btn-success">Create New Event</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Event Date</th>
                <th>Deadline Date</th>
                <th>Location</th>
                <th>Level</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Actions</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date }}</td>
                <td>{{ $event->deadline_date }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->level }}</td>
                <td>{{ $event->created_by }}</td>
                <td>{{ $event->updated_by }}</td>
                <td>
                    <a href="{{ route('eventInvite.show', $event->id) }}" class="btn btn-primary"> Event invite</a>
                </td>
                <td>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection