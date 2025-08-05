<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 container">
    <h2 class="mb-4">Edit Profile</h2>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <form method="POST" action="/update-profile">
        <?php echo csrf_field(); ?>

        <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control mb-2" required>
        <input type="email" name="email" value="<?php echo e($user->email); ?>" class="form-control mb-2" required>

        <?php if($user->role === 'student'): ?>
            <input type="text" name="class" value="<?php echo e($user->class); ?>" class="form-control mb-2" required>
        <?php elseif($user->role === 'tutor'): ?>
            <input type="text" name="subject" value="<?php echo e($user->subject); ?>" class="form-control mb-2" required>
        <?php endif; ?>

        <textarea name="bio" class="form-control mb-2" placeholder="Bio"><?php echo e($user->bio); ?></textarea>

        <input type="password" name="password" placeholder="New Password (leave blank to keep old)" class="form-control mb-3">

        <button type="submit" class="btn btn-primary">Done</button>
        <a href="/profile" class="btn btn-secondary ms-2">Cancel</a>
    </form>

    
    <?php if($user->role === 'tutor'): ?>
        <h5 class="mt-5">Edit Availability</h5>

        <form method="POST" action="/update-profile">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="name" value="<?php echo e($user->name); ?>">
            <input type="hidden" name="email" value="<?php echo e($user->email); ?>">
            <input type="hidden" name="subject" value="<?php echo e($user->subject); ?>">
            <input type="hidden" name="bio" value="<?php echo e($user->bio); ?>">

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="anytime" id="anytimeCheck" onchange="toggleTimeInputs(this)"
                    <?php echo e(isset($user->availability) && $user->availability->time_slot === 'Anytime' ? 'checked' : ''); ?>>
                <label class="form-check-label" for="anytimeCheck">Anytime</label>
            </div>

            <div class="d-flex mb-3" id="timeInputs">
                <input type="time" name="start_time" class="form-control me-2"
                    value="<?php echo e(isset($user->availability) && $user->availability->time_slot !== 'Anytime' ? explode(' - ', $user->availability->time_slot)[0] : ''); ?>">
                <span class="me-2">to</span>
                <input type="time" name="end_time" class="form-control"
                    value="<?php echo e(isset($user->availability) && $user->availability->time_slot !== 'Anytime' ? explode(' - ', $user->availability->time_slot)[1] : ''); ?>">
            </div>

            <button type="submit" class="btn btn-success">Update Availability</button>
        </form>
    <?php endif; ?>

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
<?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/edit-profile.blade.php ENDPATH**/ ?>