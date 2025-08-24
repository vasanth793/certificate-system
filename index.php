<?php
session_start();

// Default page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Restrict access to dashboard & admin if not logged in
if (($page == 'descbord' || $page == 'admin') && !isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My PHP App</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4a90e2, #0056b3);
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .container h1 {
            margin-bottom: 30px;
            color: #333;
        }

        .btn {
            display: block;
            width: 200px;
            padding: 12px;
            margin: 10px auto;
            background: #007BFF;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }

        .content {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to My App</h1>

        <!-- Buttons -->
        <a href="admin_login.php" target="_self"   class="btn">Login</a>
        <a href=" admin_register.php" target="_self" class="btn">Register</a>


    </div>
</body>
</html>
