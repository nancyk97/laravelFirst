@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Event</h1>

    <form method="POST" action="{{ route('eventsCreation') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event_date" name="event_date" required>
        </div>

        <div class="mb-3">
            <label for="deadline_date" class="form-label">Deadline Date</label>
            <input type="date" class="form-control" id="deadline_date" name="deadline_date" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select class="form-control"  name="level" :value="old('level')" required>
                <option value="">Select a Level</option>
                <option value="1">National</option>
                <option value="2">State</option>
                <option value="3">District</option>
            </select>
        </div>

      

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection