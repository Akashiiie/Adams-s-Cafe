<?php
session_start();
include("coffeeconnection.php");
// Check if the user is logged in
if (!isset($_SESSION['admin_id']) && false) {
    echo json_encode(array(
      "message" => "Unauthorized"
    ));
    exit(401);
}

 // HANDLE FOR SUBMISSION (ORDERS)
  if ( ($_SERVER["REQUEST_METHOD"] == "POST")){


    $db = (new Database())->getConnection();
    $stmt = $db->query("SELECT COUNT(*) as sales, @daytime:=CONVERT(order_time, DATE) as daytime, DAYNAME(@daytime) as day from orders WHERE CONVERT(ADDDATE(@datenow:=CURDATE(), INTERVAL -(DAYOFWEEK(@datenow)-1) DAY),DATE) <= order_time GROUP BY order_time;");
    $data = $stmt->fetchAll(PDO::FETCH_NAMED);
    if ($data === false)
      $data = [];
    die(
      json_encode($data)
    );




  }

?>