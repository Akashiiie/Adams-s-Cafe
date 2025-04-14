<?php

// Increase memory limit if needed
ini_set('memory_limit', '1024M');

// Include the database connection (PDO-based)
require 'coffeconnection.php';
$db = new Database();
$conn = $db->getConnection();

// Function to get all reviews
function getReviews() {
    global $conn;
    
    // Check if connection is valid
    if (!$conn) {
        die("Database connection failed!");
    }

    $sql = "SELECT * FROM reviews ORDER BY id DESC LIMIT 100";
    $stmt = $conn->query($sql);

    if (!$stmt) {
        die("Query failed: " . print_r($conn->errorInfo(), true));
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // PDO fetch instead of MySQLi fetch_all
}

// Function to approve a review (PDO version)
function approveReview($id) {
    global $conn;
    $sql = "UPDATE reviews SET approved = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]); // PDO uses execute() with array params
}

// Function to delete a review (PDO version)
function deleteReview($id) {
    global $conn;
    $sql = "DELETE FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}

// Handle AJAX requests (unchanged)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $response = [];

        switch ($_POST['action']) {
            case 'approve':
                if (approveReview($id)) {
                    $response['success'] = true;
                    $response['message'] = "Review approved successfully";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Error approving review";
                }
                break;


            default:
                $response['success'] = false;
                $response['message'] = "Invalid action";
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>