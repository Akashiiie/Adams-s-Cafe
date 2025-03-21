<?php
try {
    $db = new PDO('mysql:host=localhost;port=3600;dbname=your_database_name', 'your_username', 'your_password');
    // Set the PDO error mode to exception for debugging
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$stmt = $db->prepare("INSERT INTO coffee_order (flavor, size, sugar_percentage) VALUES (:flavor, :size, :sugar_percentage)");

?>