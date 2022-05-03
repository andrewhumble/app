<?php
session_start();
//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if ($_SESSION['userType'] != 3) {
    header("Location: home.php");
}
if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE>

<head>
    <link href="myAccount.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<html>

<body>

    <main>
        <?php include 'elements/header.php' ?>
        <div class="row">
            <div class="col-md-6 text-center" style="background-color:#C8D8E4;">
                <img style="padding: 14%;" src="./images/undraw_click_here_re_y6uq.svg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-md-6 text-center pt-5" style="background-color:#2B6777;">
                <h1 class="display-1 pt-5" style="color: #ffffff; font-family: Nunito; margin-top: 15%; font-size: 60px; margin-top: 5%;">My Account</h2>
                    <p style="color: #ffffff; font-family: Nunito; margin-left: 5%; margin-right: 5%; font-size: 22px;">Shopping with us is easy - all of your personal info
                        saved here for you to reference and manage whenever you
                        need to.</p>
                    <a href="admin-editMyAccount.php"><button type="button" class="btn btn-light mt-4 mb-4">Account Details</button></a> <br>
                    <a href="admin-logout.php"><button type="button" class="btn btn-light mt-4 mb-4">Logout</button></a><br>
            </div>
        </div>

        <?php include 'elements/footer.html'; ?>
    </main>
</body>