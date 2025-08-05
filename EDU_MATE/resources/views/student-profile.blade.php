<!DOCTYPE html>
<html>
<head>
    <title>Student Profile - EDU_MATE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5">

    <h2 class="mb-4">Welcome, {{ $user->name }}</h2>

    <div class="mb-3">
        <a href="/logout" class="btn btn-danger">Logout</a>
        <a href="/edit-profile" class="btn btn-secondary">Edit Profile</a>
    </div>

    <hr>

    <h4>Your Info</h4>
    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Class:</strong> {{ $user->class ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Bio:</strong> {{ $user->bio ?? 'No bio available' }}</li>
    </ul>

    <hr>

    <h4>Your Booked Sessions</h4>

    @if($bookings->isEmpty())
        <p>You haven’t booked any tutors yet.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Tutor Name</th>
                    <th>Email</th>
                    <th>Booked Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->tutor->name }}</td>
                        <td>{{ $booking->tutor->email }}</td>
                        <td>{{ $booking->booked_time_start }} - {{ $booking->booked_time_end }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>