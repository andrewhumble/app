<?php
session_start();


require_once('connDB.php');

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 1) {
    header("Location: home.php");
}

$userType = $_SESSION['userType'];

if (!isset($_SESSION['username'])) {
    header("Location: welcome.html");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}

?>

<!DOCTYPE>

<head>
    <link href="customer-confirmation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<body>
    <main>

        <?php include 'elements/header.php' ?>

        <div class="row justify-content-center">
            <div class="col-sm-8" style="background: #C8D8E4; margin: 10%; border-radius: 25px; padding: 3%; box-shadow: 2px 5px 15px #6B7379">
                <div class="row justify-content-center">
                    <div class="col-sm-8 m-2">
                        <h2 style="font-family: Nunito; text-align: center; color: #3F3D56"><strong>Thank you for shopping with <span style="font-family: Girassol; font-size: 100%">LittyLit</span></strong></h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8 m-2">
                        <h4 style="font-family: Nunito; text-align: center; color: #3F3D56">Your order was successfully completed! Check your email inbox for your order information.</h4>
                    </div>
                </div>
                <div class="row pt-5 justify-content-center">
                    <div class="col-sm-8 text-center">
                        <button style="background-color: #2B6777; border: 5px solid #2B6777; box-shadow: 5px 5px 15px #6B7379;" class="btn btn-primary px-3"><a href="home.php" style="font-family: Nunito; font-size: 130%; color: #ffffff">Return to Home Page</a></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>