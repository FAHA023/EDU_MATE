<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h2>Student Registration</h2>
    <form method="POST" action="/register/student">
        <?php echo csrf_field(); ?>
        <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="text" name="class" placeholder="Class" class="form-control mb-2" required>
        <textarea name="bio" placeholder="Bio" class="form-control mb-2"></textarea>
        <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Done</button>
    </form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/register-student.blade.php ENDPATH**/ ?>