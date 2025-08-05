<!DOCTYPE html>
<html>
<head>
    <title>Tutor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>Tutor Login</h2>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <form method="POST" action="/login/tutor">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/login-tutor.blade.php ENDPATH**/ ?>