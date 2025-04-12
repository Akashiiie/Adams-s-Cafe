<?php 
session_start();
require 'coffeconnection.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate inputs
    if (!empty($email) && !empty($password)) {

        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: dashboard.php');
            exit();
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href= "login.css">
</head>
<body>



    <div class="container">
        <img src="Primary_Logo-removebg-preview.png" alt="Logo" class="logo">   
        <h2>LOG IN</h2>
        <form method="POST" id="loginForm">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" name="email" required>

            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" placeholder="Enter your password" name="password" required>
            </div>

            <div class="options">
                <label><input type="checkbox"> Remember me</label>
                <a href="forgotpassword.php">Forgot Password?</a>
            </div>
            <?php echo $login_error;?>
            <button type="submit">Login</button>
            <a href="register.php">Register</a>
    

        </form>
            
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>