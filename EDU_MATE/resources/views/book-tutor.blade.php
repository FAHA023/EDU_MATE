<!DOCTYPE html>
<html>
<head>
    <title>Book Tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5">

    <h2>Book {{ $tutor->name }}</h2>

    @if($tutor->availability)
        <p><strong>Available:</strong> {{ $tutor->availability->time_slot }}</p>
    @else
        <p><em>This tutor has not set availability. You can choose any time (1 or 2 hour only).</em></p>
    @endif

    <form method="POST" action="/book-tutor">
        @csrf
        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">

        <div class="mb-3">
            <label>Start Time:</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Time:</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </form>

</body>
</html>
