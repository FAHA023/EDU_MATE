<!DOCTYPE html>
<html>
<head>
    <title>Book Tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5">

    <h2>Book <?php echo e($tutor->name); ?></h2>

    <?php if($tutor->availability): ?>
        <p><strong>Available:</strong> <?php echo e($tutor->availability->time_slot); ?></p>
    <?php else: ?>
        <p><em>This tutor has not set availability. You can choose any time (1 or 2 hour only).</em></p>
    <?php endif; ?>

    <form method="POST" action="/book-tutor">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="tutor_id" value="<?php echo e($tutor->id); ?>">

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
<?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/book-tutor.blade.php ENDPATH**/ ?>