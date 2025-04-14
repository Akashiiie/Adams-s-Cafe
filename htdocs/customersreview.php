<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews - Admin Dashboard</title>
    <link rel="stylesheet" href="customersreview.css">
    <style>
        .approved { background-color: #e6ffe6; }
        .pending { background-color: #fff3e6; }
        .btn-approve { 
            background-color: #4CAF50; 
            color: white; 
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-delete { 
            background-color: #f44336; 
            color: white; 
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-approve:hover { background-color: #45a049; }
        .btn-delete:hover { background-color: #d32f2f; }
        .rating { color: gold; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar (same as before) -->
        <aside class="sidebar">
            <div class="logo">
                <img src="Primary_Logo-removebg-preview.png" alt="Cafe Logo">
            </div>
            <div class="profile">
                <img src="download-removebg-preview.png" alt="Admin Profile">
                <p>Admin</p>
                <a href="editprofile.html">Edit Profile</a>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="order.php">Orders</a></li>
                    <li><a href="customersreview.php">Customers</a></li>
                    <li><a href="usermngt.php">Customer Management</a></li>
                </ul>
            </nav>
            <a href="login.php">⬅ Logout</a>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1>Customer Reviews</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="review-table">
                    <?php
                    include 'review_action.php';
                    $reviews = getReviews();
                    
                    if (count($reviews) > 0) {
                        foreach ($reviews as $row) {
                            $status = $row['approved'] ? 'Approved' : 'Pending';
                            $rowClass = $row['approved'] ? 'approved' : 'pending';
                            $stars = str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating']);
                            
                            echo "<tr class='$rowClass'>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['customer_name']}</td>";
                            echo "<td>{$row['review_text']}</td>";
                            echo "<td class='rating'>{$stars}</td>";
                            echo "<td>{$status}</td>";
                            echo "<td>";
                            if (!$row['approved']) {
                                echo "<button class='btn-approve' data-id='{$row['id']}'>Approve</button>";
                            }
                            echo "<button class='btn-delete' data-id='{$row['id']}'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No reviews found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle approve button clicks
            document.querySelectorAll('.btn-approve').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    updateReview(id, 'approve');
                });
            });
            
            // Handle delete button clicks
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this review?')) {
                        updateReview(id, 'delete');
                    }
                });
            });
            
            function updateReview(id, action) {
                fetch('review_functions.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=${action}&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
            }
        });
    </script>
</body>
</html>