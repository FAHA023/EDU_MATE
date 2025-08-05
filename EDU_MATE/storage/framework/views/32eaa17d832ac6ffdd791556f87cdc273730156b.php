<!DOCTYPE html>
<html>
<head>
    <title>Student Profile - EDU_MATE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5">

    <h2 class="mb-4">Welcome, <?php echo e($user->name); ?></h2>

    <div class="mb-3">
        <a href="/logout" class="btn btn-danger">Logout</a>
        <a href="/edit-profile" class="btn btn-secondary">Edit Profile</a>
    </div>

    <hr>

    <h4>Your Info</h4>
    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Name:</strong> <?php echo e($user->name); ?></li>
        <li class="list-group-item"><strong>Email:</strong> <?php echo e($user->email); ?></li>
        <li class="list-group-item"><strong>Class:</strong> <?php echo e($user->class ?? 'N/A'); ?></li>
        <li class="list-group-item"><strong>Bio:</strong> <?php echo e($user->bio ?? 'No bio available'); ?></li>
    </ul>

    <hr>

    <h4>Your Booked Sessions</h4>

    <?php if($bookings->isEmpty()): ?>
        <p>You haven’t booked any tutors yet.</p>
    <?php else: ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Tutor Name</th>
                    <th>Email</th>
                    <th>Booked Time</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($booking->tutor->name); ?></td>
                        <td><?php echo e($booking->tutor->email); ?></td>
                        <td><?php echo e($booking->booked_time_start); ?> - <?php echo e($booking->booked_time_end); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/student-profile.blade.php ENDPATH**/ ?>