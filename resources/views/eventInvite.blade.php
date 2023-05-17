@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Event Details</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $event->title }}</h4>
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <span><strong>Event Date:</strong> {{ $event->event_date }}</span>
                        </td>
                        <td>
                            <span><strong>Deadline Date:</strong> {{ $event->deadline_date }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><strong>Location:</strong> {{ $event->location }}</span>
                        </td>
                        <td>
                            <span><strong>Level:</strong> {{ $event->level }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>

                    <h2>Coaches</h2>
                </th>
                <th>
                    <h2>Invite Coach </h2>

                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table">
                        <thead>
                            <th>Username</th>
                            <th>Password</th>
                            <th></th>


                        </thead>
                        <tbody>
                            @foreach($otherCoaches as $coach)
                            <tr>
                                <td>
                                    <span> {{ $coach->username }}</span>
                                </td>
                                <td>
                                    <span> <input type="password" class="form-control border-remove" id="ip{{ $coach->id }}" name="password" value="{{ $coach->password }}"></span>
                                </td>
                                <td>
                                    <div class="password-toggle" id="tp{ $coach->id }}" onclick="togglePasswordVisibility('{{ $coach->id }}')"><i class="fa fa-eye"></i></div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                </td>
                <td>
                    <form action="{{ route('events.saveCredentials', ['id' => $event->id]) }}" method="POST">
                        @csrf

                        <div class="coach-container">
                            <div class="coach-input">
                                <label for="coach_username">Username:</label>
                                <input class="form-control" type="text" name="coach_username[]" required>
                            </div>

                            <div class="coach-input">
                                <label for="coach_password">Password:</label>
                                <input class="form-control" type="password" name="coach_password[]" required>
                            </div>
                        </div>
                        <div>

                            <button type="button" class="btn btn-primary" onclick="addCoachFields()">Add Coach</button>
                            <button type="submit" class="btn btn-danger">Save Credentials</button>
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>





    <script>
        function addCoachFields() {
            const container = document.querySelector('.coach-container');
            const inputDiv = document.createElement('div');
            inputDiv.classList.add('coach-input');
            inputDiv.innerHTML = `
            <div class="coach-input">
                <label for="coach_username">Username:</label>
                <input class="form-control" type="text" name="coach_username[]" required>
            </div>
            `;
            container.appendChild(inputDiv);

            const passwordDiv = document.createElement('div');
            passwordDiv.classList.add('coach-input');
            passwordDiv.innerHTML = `
            <div class="coach-input">
                <label for="coach_password">Password:</label>
                <input class="form-control" type="password" name="coach_password[]" required>
            </div>
            `;
            container.appendChild(passwordDiv);
        }
    </script>
    <script>
        function togglePasswordVisibility($id) {
            var passwordInput = $('#ip'+$id);
            var passwordToggle = $('#tp'+$id);

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                passwordToggle.html('<i class="fa fa-eye-slash"></i>');
            } else {
                passwordInput.attr('type', 'password');
                passwordToggle.html('<i class="fa fa-eye"></i>');
            }
        }
    </script>
    @endsection