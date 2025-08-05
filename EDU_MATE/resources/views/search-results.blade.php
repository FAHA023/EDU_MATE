<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>Search Results for "{{ $subject }}"</h2>

    @if ($tutors->isEmpty())
        <p>No tutors found for this subject.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Bio</th>
                    <th><strong>Availability</strong></th>
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
