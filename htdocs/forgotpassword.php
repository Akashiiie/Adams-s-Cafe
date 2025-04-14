<?php
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = ($_POST["email"]);
    $oldpass = ($_POST["oldpass"]);
    $newPassword = $_POST["new-password"];
    $confirmPassword = $_POST["confirm-password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email address.";
    } elseif (strlen($newPassword) < 6) {
        $errorMessage = "Password must be at least 6 characters long.";
    } elseif ($newPassword !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=coffe_theater2", "your_username", "your_password");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->execute([
                'password' => $hashedPassword,
                'email' => $email
            ]);

            if ($stmt->rowCount() > 0) {
                header("Location: login.php");
                exit();
            } else {
                $errorMessage = "Email not found.";
            }

        } catch (PDOException $e) {
            $errorMessage = "Database error: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <img src="Primary_Logo-removebg-preview.png" alt="Logo" class="logo">
        <h2>Forgot Password</h2>

        <!-- Success/Error messages -->
        <?php if ($errorMessage): ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php elseif ($successMessage): ?>
            <p style="color: green;"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <form id="resetForm" action="" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="new-password">New Password</label>
            <div class="password-container">
                <input type="password" id="new-password" name="new-password" placeholder="Enter new password" required>
            </div>

            <label for="confirm-password">Confirm Password</label>
            <div class="password-container">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password" required>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
