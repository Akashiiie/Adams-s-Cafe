<?php
include "db.sql"; // Ensure this connects to the database


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow access from any client
header("Access-Control-Allow-Methods: GET");

// Fetch orders from the database
$sql = "SELECT id, title, description, Orders, image FROM orders ORDER BY Orders ASC";
$result = $conn->query($sql);

$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode(["success" => true, "orders" => $orders]);
} else {
    echo json_encode(["success" => false, "message" => "No orders found"]);
}

$conn->close();
?>