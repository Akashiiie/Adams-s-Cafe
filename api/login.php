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

        $stmt = $db->prepare("SELECT coffe_id, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['coffe_id'] = $user['coffe_id'];
            $_SESSION['email'] = $user['email'];
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

