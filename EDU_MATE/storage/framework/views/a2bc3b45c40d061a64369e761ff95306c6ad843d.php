<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EDU_MATE</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fff8f1; #f4f6f8;
            font-family: 'Poppins', sans-serif;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .hero {
            text-align: center;
            padding: 80px 20px 40px;
        }

        .hero h1 {
            font-weight: 600;
            font-size: 42px;
            color: #2c3e50;
        }

        .hero p {
            font-size: 18px;
            color: #6c757d;
            margin-top: 10px;
        }

        .about {
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            margin-top: 30px;
            text-align: center;
        }

        .about h4 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .about p {
            color: #495057;
            font-size: 16px;
        }

        .btn-custom {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <a href="/about" class="btn btn-outline-primary">About Us</a>
        <div>
            <a href="/login" class="btn btn-outline-success btn-custom">Sign In</a>
            <a href="/register" class="btn btn-outline-secondary btn-custom">Register</a>
        </div>
    </div>

    <div class="hero">
        <h1>Welcome to <span style="color:#8d6e63;">EDU_MATE</span></h1>
        <p>"Bridging Students and Tutors — Anytime, Anywhere."</p>
    </div>

    <div class="about">
        <h4>About EDU_MATE</h4>
        <p>
            EDU_MATE is your go-to platform for connecting students with qualified tutors based on subject, availability, and shared interests.
            Whether you're looking for academic support or eager to share your knowledge — EDU_MATE brings education closer to you.
        </p>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\EDU_MATE\resources\views/welcome.blade.php ENDPATH**/ ?>