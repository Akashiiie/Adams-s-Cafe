<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "coffe_theater2");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM customers WHERE id=$id");
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $orders = $_POST['orders'];

    $conn->query("UPDATE customers SET name='$name', email='$email', phone='$phone', orders=$orders WHERE id=$id");
    header("Location: usermngt.php");
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    Name: <input type="text" name="name" value="<?= $row['name'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $row['email'] ?>"><br>
    Phone: <input type="text" name="phone" value="<?= $row['phone'] ?>"><br>
    Orders: <input type="number" name="orders" value="<?= $row['orders'] ?>"><br>
    <button type="submit" name="update">Update</button>
</form>
