<?php
require 'coffeconnection.php';

$database = new Database();
$conn = $database->getConnection();

// Handle form submission for Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $orders = $_POST['orders'] ?? '';

    if (!empty($name) && !empty($email)) {
        if (!empty($id)) {
            // UPDATE
            $stmt = $conn->prepare("UPDATE customers SET name=?, email=?, phone=?, orders=? WHERE id=?");
            $result = $stmt->execute([$name, $email, $phone, $orders, $id]);
            $msg = $result ? "Customer updated successfully." : "Failed to update customer.";
        } else {
            // INSERT
            $stmt = $conn->prepare("INSERT INTO customers(name, email, phone, orders) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$name, $email, $phone, $orders]);
            $msg = $result ? "Customer added successfully." : "Failed to add customer.";
        }

        echo "<script>alert('$msg'); window.location.href='usermngt.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="mainpage.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="admin-dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="Primary_Logo-removebg-preview.png" alt="Cafe Logo">
            </div>
            <div class="admin-info">
                <img src="download-removebg-preview.png" alt="Admin">
                <h3>Admin</h3>
                <a href="editprofile.php">Edit Profile</a>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="order.php">Orders</a></li>
                    <li><a href="customersreview.php">Customers Reviews</a></li>
                    <li><a href="usermngt.php">User Management</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="login.php">⬅ Logout</a>
            </div>
        </aside>
    <meta charset="UTF-8">
    <title>Customer Management</title>
    <link rel="stylesheet" href="usermngt.css">
    <style>
        .form-container { margin-bottom: 20px; }
        input, button { padding: 5px; margin: 5px; }
        .delete-btn, .edit-btn {
            padding: 5px 8px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .delete-btn { background: crimson; }
        .edit-btn { background: #007BFF; }
    </style>
</head>
<body>
<div class="admin-dashboard">
    <main class="content">
        <h2 id="form-title">Create New Customer</h2>
        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="id" id="customer-id">
                <input type="text" name="name" id="name" placeholder="Name" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="text" name="phone" id="phone" placeholder="Phone">
                <input type="number" name="orders" id="orders" placeholder="Orders">
                <button type="submit" id="submit-btn">Add Customer</button>
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
                                <button class='edit-btn' onclick='editUser(this)'>Edit</button>
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

function editUser(button) {
    const row = button.closest("tr");
    const id = row.getAttribute("data-id");
    const cells = row.querySelectorAll("td");

    document.getElementById("customer-id").value = id;
    document.getElementById("name").value = cells[0].innerText;
    document.getElementById("email").value = cells[1].innerText;
    document.getElementById("phone").value = cells[2].innerText;
    document.getElementById("orders").value = cells[3].innerText;

    document.getElementById("form-title").innerText = "Edit Customer";
    document.getElementById("submit-btn").innerText = "Update Customer";
}
</script>
</body>
</html>
