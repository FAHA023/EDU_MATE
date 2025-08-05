<!DOCTYPE html>
<html>
<head>
    <title>All Tutors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>All Tutors</h2>

    <?php if($tutors->isEmpty()): ?>
        <p>No tutors found.</p>
    <?php else: ?>
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
                <?php $__currentLoopData = $tutors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($tutor->name); ?></td>
                        <td><?php echo e($tutor->email); ?></td>
                        <td><?php echo e($tutor->subject); ?></td>
                        <td><?php echo e($tutor->bio); ?></td>
                        <td>
                            <?php if($tutor->availability): ?>
                                <?php echo e($tutor->availability->time_slot); ?>

                            <?php else: ?>
                                <em>Not available yet</em>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" action="/add-tutor">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="tutor_id" value="<?php echo e($tutor->id); ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/profile" class="btn btn-secondary mt-3">Back to Profile</a>
</body>
</html><?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/view-all-tutors.blade.php ENDPATH**/ ?>