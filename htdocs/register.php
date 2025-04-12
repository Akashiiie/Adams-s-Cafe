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

        $stmt = $db->prepare("INSERT INTO users( email, password) VALUES(?,?)");
        $password =password_hash($password,PASSWORD_DEFAULT);
        $OK=$stmt->execute([$email,$password]);
        
        if ($OK !== false){
          header("Location: dashboard.php",true);
        }
    } else {
        $login_error = 'Please enter both email and password';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 300px;
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .register-container label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .register-container input[type="text"],
    .register-container input[type="email"],
    .register-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .register-container input[type="submit"] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .register-container input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h2>Register</h2>
    <form method="POST">
      <label for="email">email</label>
      <input type="text" id="email"  name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Register">
    </form>
  </div>

</body>
</html>
