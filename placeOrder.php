<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

require 'vendor/autoload.php';

$length = 0;
isset($_POST['length']) ? $length = $_POST['length'] : ($length = $_GET['length'] ?? "");

$promoAmt = 0;
isset($_POST['promoAmt']) ? $promoAmt = $_POST['promoAmt'] : ($promoAmt = $_GET['promoAmt'] ?? "");
echo $promoAmt;

$total = 0;
isset($_POST['total']) ? $total = $_POST['total'] : ($total = $_GET['total'] ?? "");

$orderID = "";

$order = array_fill(0, $length, NULL);

isset($_POST['order']) ? $order = $_POST['order'] : ($order = $_GET['order'] ?? "");

$postReport = "SELECT title, ISBN, quantity, price, stock FROM cart WHERE username='$username';";
$values = $conn->query($postReport);

$maxQuery = "SELECT MAX(order_id) as max_id FROM orders;";
$maxResult = $conn->query($maxQuery);
$orderIDNum = mysqli_fetch_array($maxResult);
$order_id = $orderIDNum['max_id'] + 10;
$confirmation_num = $order_id + 132;

while ($row = mysqli_fetch_array($values)) {
    $getVendorQuery = "SELECT username FROM book WHERE isbn='$row[ISBN]';";
    $vendorRet = $conn->query($getVendorQuery);
    $vendorArr = mysqli_fetch_array($vendorRet);
    $vendor = $vendorArr['username'];

    $check = "SELECT * FROM report WHERE ISBN='$row[ISBN]'";
    $checkResult = $conn->query($check);
    if (mysqli_num_rows($checkResult) == 0) {
        $insert = "INSERT INTO report (title, ISBN, sold, cost, revenue, vendor, stock, order_id) VALUES ('$row[title]', '$row[ISBN]', '$row[quantity]', $row[price], $promoAmt, '$vendor', $row[stock], $order_id);";
        $conn->query($insert);
    } else {
        $getId = "SELECT order_id FROM report WHERE ISBN='$row[ISBN]'";
        $idRet = $conn->query($getId);
        $idArr = mysqli_fetch_array($idRet);
        $temp = $idArr['order_id'];

        $update = "UPDATE report SET sold = sold + $row[quantity], cost = $row[price], stock = $row[stock], revenue = revenue + $promoAmt WHERE order_id = $temp;";
        $conn->query($update);
    }
}

$userInfoQuery = "SELECT * FROM userInfo WHERE username='$username';";
$userInfo = $conn->query($userInfoQuery);
$user = mysqli_fetch_array($userInfo);

$date = date('Y-m-d');

foreach ($order as $item) {
    $orderQuery = "INSERT INTO orders VALUES('$user[firstName]', '$user[lastName]', '$username', $order_id, $confirmation_num, '$date', '$user[strAddress]', '$user[city]', '$user[state]', '$user[zip]', '$item[ISBN]', $item[price], $item[quantity], $promoAmt);";
    $orderResult = $conn->query($orderQuery);

    $reduceStock = "UPDATE book SET stock = stock - $item[quantity] WHERE ISBN = '$item[ISBN]'";
    $conn->query($reduceStock);
}

$check = "SELECT email FROM userInfo WHERE username = '$username'";
$result = $conn->query($check);
$values = mysqli_fetch_array($result);
$email = $values['email'];

$help = "SELECT * FROM orders WHERE username = '$username'";
$res = $conn->query($help);
$val = mysqli_fetch_array($res);
$firstName = $val['firstName'];
$confirmationID = $val['confirmation_id'];
$orderID = $val['order_id'];
$orderDate = $val['day_ordered'];
$total = $val['quantity'] * $val['price'];


$okay = "SELECT * FROM orders WHERE order_id= '$orderID';";
$p = $conn->query($okay);

$length = mysqli_num_rows($p);

$order = array_fill(0, $length, NULL);

$items = array_fill(0, $length, NULL);

$i = 0;
while ($row = mysqli_fetch_array($p)) {
    $order[$i] = $row;
    $i++;
}



$quantity = 0;
foreach ($order as $o) {
    $quantity = $quantity + $o['quantity'];
}

$total = $quantity * $val['price'];

$mail = new PHPMailer(true);

//Server settings
$mail->SMTPDebug = 1;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->Username   = "OfficialLittyLit@gmail.com";                     //SMTP username
$mail->Password   = "mean1234";                               //SMTP password
$mail->Subject = "Order Confirmation!";


$mail->setFrom("OfficialLittyLit@gmail.com");

$body = '<strong>Hello ' . $firstName . '!</strong><p> Thank you so much for buying from LittyLit. We hope you enjoy your read!</p><br>
        <p>Below is your order summary:</p><br><br>
        <b>Confirmation Number: ' . $confirmationID . '</b><br>
        <b>Order ID: ' . $orderID . '</b><br>
        <b>Date Ordered: ' . $orderDate . '</b><br>
        <b># of Ordered Items: ' . $quantity . '</b><br>
        <b>Total Cost: $' . $total . '</b><br>

        <h4>Have a great rest of your day!</h4><br><br>

        <p>Sincerely, Litty Lit Exec Board</p>
       


        

        ';

// foreach($order as $o) {
//     echo $o['ISBN'];
// }

$mail->isHTML(true);
$mail->Body    = $body;

$mail->addAddress($email);
if ($mail->Send()) {
} else {

    echo "Ur Stupid";
}



$emptyQuery = "DELETE FROM cart WHERE username='$username';";
$execCartEmpty = $conn->query($emptyQuery);

header("Location: customer-confirmation.php");



# foreach ($order as $item) {
#     $postReport = "SELECT title, ISBN, quantity FROM cart WHERE username='$username';";
#     $values = $conn->query($postReport);
# }
# header("Location: customer-confirmation.php");
