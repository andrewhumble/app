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

$total = 0;
isset($_POST['total']) ? $total = $_POST['total'] : ($total = $_GET['total'] ?? "");

$orderID = "";

$order = array_fill(0, $length, NULL);

isset($_POST['order']) ? $order = $_POST['order'] : ($order = $_GET['order'] ?? "");

$postReport = "SELECT title, ISBN, quantity, price, stock FROM cart WHERE username='$username';";
$values = $conn->query($postReport);
while ($row = mysqli_fetch_array($values)) {
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

$userInfoQuery = "SELECT * FROM userInfo WHERE username='$username';";
$userInfo = $conn->query($userInfoQuery);
$user = mysqli_fetch_array($userInfo);

$maxQuery = "SELECT MAX(order_id) as max_id FROM orders;";
$maxResult = $conn->query($maxQuery);
$orderIDNum = mysqli_fetch_array($maxResult);
$order_id = $orderIDNum['max_id'] + 10;
$confirmation_num = $order_id + 132;

$date = date('Y-m-d');

foreach ($order as $item) {
    $orderQuery = "INSERT INTO orders VALUES('$user[firstName]', '$user[lastName]', '$username', $order_id, $confirmation_num, '$date', '$user[strAddress]', '$user[city]', '$user[state]', '$user[zip]', '$item[ISBN]', $item[price], $item[quantity], $promoAmt);";
    $orderResult = $conn->query($orderQuery);

    $reduceStock = "UPDATE book SET stock = stock - $item[quantity] WHERE ISBN = '$item[ISBN]'";
    $conn->query($reduceStock);
}

// $check = "SELECT email FROM userInfo WHERE username = '$username'";

    
// $mail = new PHPMailer(true);

//         //Server settings
//         $mail->SMTPDebug = 1;                      //Enable verbose debug output
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
//         $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//         $mail->Username   = "OfficialLittyLit@gmail.com";                     //SMTP username
//         $mail->Password   = "mean1234";                               //SMTP password
//         $mail->Subject = "Stuff";


//         $mail->setFrom("OfficialLittyLit@gmail.com");

//         $body = '<strong>Hello!</strong> Welcome to LittyLit. Here is your verification Code: ';

//             $mail->isHTML(true);
//             $mail->Body    = $body;

//             $mail->addAddress($check);
//             if ($mail->Send()) {
                
//             } else {
                
//                 echo "Ur Stupid";
//             }
//             $mail->smtpClose();

            

$emptyQuery = "DELETE FROM cart WHERE username='$username';";
$execCartEmpty = $conn->query($emptyQuery);

header("Location: customer-confirmation.php");



# foreach ($order as $item) {
#     $postReport = "SELECT title, ISBN, quantity FROM cart WHERE username='$username';";
#     $values = $conn->query($postReport);
# }
# header("Location: customer-confirmation.php");
