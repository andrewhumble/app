<?php

session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$userType = $_SESSION['userType'];

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}

$length = 0;
isset($_POST['length']) ? $length = $_POST['length'] : ($length = $_GET['length'] ?? "");

$total = 0;
isset($_POST['total']) ? $total = $_POST['total'] : ($total = $_GET['total'] ?? "");

$orderID = "";

$order = array_fill(0, $length, NULL);

isset($_POST['order']) ? $order = $_POST['order'] : ($order = $_GET['order'] ?? "");

$postReport = "SELECT title, ISBN, quantity, price, stock FROM cart WHERE username='$username';";
$values = $conn->query($postReport);
while ($row = mysqli_fetch_array($values)) {
    echo $row['ISBN'];
    echo "<br>";
    $check = "SELECT * FROM report WHERE ISBN='$row[ISBN]'";
    $checkResult = $conn->query($check);
    if (mysqli_num_rows($checkResult) == 0) {
        $insert = "INSERT INTO report (title, ISBN, sold, cost, revenue, stock) VALUES ('$row[title]', '$row[ISBN]', '$row[quantity]', $row[price], 0, $row[stock]);";
        $conn->query($insert);
    } else {
        $update = "UPDATE report SET sold = sold + '$row[quantity]', cost = $row[price], stock = $row[stock] WHERE ISBN = '$row[ISBN]';";
        $conn->query($update);
    }
}

# foreach ($order as $item) {
#     $postReport = "SELECT title, ISBN, quantity FROM cart WHERE username='$username';";
#     $values = $conn->query($postReport);
# }
# header("Location: customer-confirmation.php");
