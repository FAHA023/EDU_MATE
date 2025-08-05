<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>Welcome, <?php echo e($user->name); ?></h2>

    <a href="/logout" class="btn btn-danger mb-3">Logout</a>
    <a href="/profile/edit" class="btn btn-warning mb-3 ms-2">Edit Profile</a>

    <p><strong>Role:</strong> <?php echo e(ucfirst($user->role)); ?></p>
    <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
    <?php if($user->role === 'student'): ?>
        <p><strong>Class:</strong> <?php echo e($user->class); ?></p>
    <?php elseif($user->role === 'tutor'): ?>
        <p><strong>Subject:</strong> <?php echo e($user->subject); ?></p>
    <?php endif; ?>
    <p><strong>Bio:</strong> <?php echo e($user->bio); ?></p>

    <?php if($user->role === 'student'): ?>
        <hr>
        <h3>Find a Tutor</h3>
        <form action="/search-tutors" method="GET" class="mb-3 d-flex">
            <input type="text" name="subject" class="form-control me-2" placeholder="Enter subject..." required>
            <button type="submit" class="btn btn-success me-2">Search</button>
            <a href="/view-all-tutors" class="btn btn-primary">View All</a>
        </form>
    <?php endif; ?>

    <?php if($user->role === 'tutor'): ?>
        <hr>
        <h4>Availability:</h4>
        <?php if($user->availability): ?>
            <p><?php echo e($user->availability->time_slot); ?></p>
        <?php else: ?>
            <p><em>No availability set yet.</em></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/profile.blade.php ENDPATH**/ ?>