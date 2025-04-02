<?php
session_start();
require 'coffeeconnection.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate inputs
    if (!empty($email) && !empty($password)) {

        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("SELECT email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            header('Location: dashboard.php');
            exit;
        } else {
            $login_error = 'Invalid email or password';
        }
    } else {
        $login_error = 'Please enter both email and password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body { font-family: Arial, sans-serif; background-color:rgba(216, 210, 210, 0.99); text-align: center; }
        .login-container { width: 300px; padding: 20px; background: white; margin: 90px auto; border-radius: 4px; box-shadow: 0 0 10px #ccc; }
        input[type="text"], input[type="password"] { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 90%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background:rgb(16, 34, 20); }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="login-container">
    <img src="Primary_Logo-removebg-preview.png" alt="Logo" class="logo">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>

