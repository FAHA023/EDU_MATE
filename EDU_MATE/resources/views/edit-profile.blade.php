<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 container">
    <h2 class="mb-4">Edit Profile</h2>

    {{-- Show success/error if available --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FIX: Corrected the form action --}}
    <form method="POST" action="/update-profile">
        @csrf

        <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-2" required>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-2" required>

        @if($user->role === 'student')
            <input type="text" name="class" value="{{ $user->class }}" class="form-control mb-2" required>
        @elseif($user->role === 'tutor')
            <input type="text" name="subject" value="{{ $user->subject }}" class="form-control mb-2" required>
        @endif

        <textarea name="bio" class="form-control mb-2" placeholder="Bio">{{ $user->bio }}</textarea>

        <input type="password" name="password" placeholder="New Password (leave blank to keep old)" class="form-control mb-3">

        <button type="submit" class="btn btn-primary">Done</button>
        <a href="/profile" class="btn btn-secondary ms-2">Cancel</a>
    </form>

    {{-- Tutor availability section --}}
    @if ($user->role === 'tutor')
        <h5 class="mt-5">Edit Availability</h5>

        <form method="POST" action="/update-profile">
            @csrf

            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="subject" value="{{ $user->subject }}">
            <input type="hidden" name="bio" value="{{ $user->bio }}">

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="anytime" id="anytimeCheck" onchange="toggleTimeInputs(this)"
                    {{ isset($user->availability) && $user->availability->time_slot === 'Anytime' ? 'checked' : '' }}>
                <label class="form-check-label" for="anytimeCheck">Anytime</label>
            </div>

            <div class="d-flex mb-3" id="timeInputs">
                <input type="time" name="start_time" class="form-control me-2"
                    value="{{ isset($user->availability) && $user->availability->time_slot !== 'Anytime' ? explode(' - ', $user->availability->time_slot)[0] : '' }}">
                <span class="me-2">to</span>
                <input type="time" name="end_time" class="form-control"
                    value="{{ isset($user->availability) && $user->availability->time_slot !== 'Anytime' ? explode(' - ', $user->availability->time_slot)[1] : '' }}">
            </div>

            <button type="submit" class="btn btn-success">Update Availability</button>
        </form>
    @endif

    <script>
        function toggleTimeInputs(checkbox) {
            document.getElementById('timeInputs').style.display = checkbox.checked ? 'none' : 'flex';
        }

        window.onload = () => {
            const box = document.getElementById('anytimeCheck');
            toggleTimeInputs(box);
        };
    </script>
</body>
</html>
