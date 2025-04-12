<?php
require 'coffeconnection.php';

$database = new Database();
$conn = $database->getConnection();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $orders = $_POST['orders'] ?? '';

    if (!empty($name) && !empty($email)) {
        $stmt = $conn->prepare("INSERT INTO customers(name, email, phone, orders) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $phone, $orders]);

        if ($result) {
            echo "<script>alert('Customer added successfully.'); window.location.href='usermngt.php';</script>";
        } else {
            echo "<script>alert('Failed to add customer.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Management</title>
    <link rel="stylesheet" href="usermngt.css">
    <style>
        .form-container { margin-bottom: 20px; }
        input, button { padding: 5px; margin: 5px; }
        .delete-btn {
            background: crimson;
            color: white;
            border: none;
            padding: 5px 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="admin-dashboard">
    <main class="content">
        <h2>Create New Customer</h2>
        <div class="form-container">
            <form method="POST">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Phone">
                <input type="number" name="orders" placeholder="Orders">
                <button type="submit">Add Customer</button>
            </form>
        </div>

        <div class="table-container">
            <table id="customer-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="customer-body">
                <?php
                $stmt = $conn->query("SELECT * FROM customers");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr data-id='{$row['id']}'>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['orders']}</td>
                            <td>
                                <button class='delete-btn' onclick='deleteUser({$row['id']}, this)'>Delete</button>
                            </td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
function deleteUser(id, btn) {
    if (!confirm("Are you sure you want to delete this customer?")) return;

    fetch('delete.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.text())
    .then(response => {
        if (response.trim() === 'success') {
            alert("Customer deleted.");
            btn.closest("tr").remove();
        } else {
            alert("Failed to delete customer.");
        }
    });
}
</script>
</body>
</html>