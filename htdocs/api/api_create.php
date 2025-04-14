<?php
require 'coffeconnection.php';

$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $name = $data->name;
    $email = $data->email;
    $phone = $data->phone;
    $orders = $data->orders;

    $stmt = $conn->prepare("INSERT INTO customers(name, email, phone, orders) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $phone, $orders);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "no data";
}
?>
