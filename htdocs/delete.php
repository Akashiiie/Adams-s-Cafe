<?php
require 'coffeconnection.php';

$input = json_decode(file_get_contents("php://input"));

if (isset($input->id)) {
    $id = $input->id;

    $database = new Database();
    $conn = $database->getConnection();

    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid";
}
?>
