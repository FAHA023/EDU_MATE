<!DOCTYPE html>
<html>
<head>
    <title>All Tutors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>All Tutors</h2>

    @if ($tutors->isEmpty())
        <p>No tutors found.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Bio</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tutors as $tutor)
                    <tr>
                        <td>{{ $tutor->name }}</td>
                        <td>{{ $tutor->email }}</td>
                        <td>{{ $tutor->subject }}</td>
                        <td>{{ $tutor->bio }}</td>
                        <td>
                            @if ($tutor->availability)
                                {{ $tutor->availability->time_slot }}
                            @else
                                <em>Not available yet</em>
                            @endif
                        </td>
                        <td>
                            <a href="/book-tutor/{{ $tutor->id }}" class="btn btn-sm btn-primary">Add</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="/book-tutor/{{ $tutor->id }}" class="btn btn-sm btn-primary">Add</a>

</body>
</html>