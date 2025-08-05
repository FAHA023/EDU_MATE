<!DOCTYPE html>
<html>
<head>
    <title>Set Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>Set Your Availability</h2>

    <form method="POST" action="/tutor/set-availability">
        @csrf

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="anytime" id="anytimeCheck" onchange="toggleTimeInputs(this)">
            <label class="form-check-label" for="anytimeCheck">Anytime</label>
        </div>

        <div class="d-flex mb-3" id="timeInputs">
            <input type="time" name="start_time" class="form-control me-2" required>
            <span class="me-2">to</span>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Availability</button>
    </form>

    <script>
        function toggleTimeInputs(checkbox) {
            document.getElementById('timeInputs').style.display = checkbox.checked ? 'none' : 'flex';
        }
    </script>
</body>
</html>
