<?php
include('db.php');
// Make sure you have a database connection

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Get order path
    $stmt = $conn->prepare("SELECT order FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->bind_result($order);
    $stmt->fetch();
    $stmt->close();

    // Delete order file if it exists
    if (!empty($order) && file_exists($order)) {
        unlink($order); // Delete the order file
    }

    // Delete order from database
    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Redirect back to dashboard
        exit();
    } else {
        echo "Error deleting order.";
    }
}
?>
