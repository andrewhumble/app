<?php
require_once('connDB.php');
// Check connection
if ($conn == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

############
session_start();

//connect to database
require_once('connDB.php');

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
    $promotion = $_SESSION['promotion'];
}

$getValuesQuery = "SELECT firstName, lastName, password, email, birthday, strAddress, city, state, zip FROM userInfo WHERE username='" . $_SESSION['username'] . "';";

$values = $conn->query($getValuesQuery);
$row = $values->fetch_assoc();

$firstName = isset($row['firstName']) ? htmlspecialchars($row['firstName']) : '';
$lastName = isset($row['lastName']) ? htmlspecialchars($row['lastName']) : '';
$password = $row['password'];
$email = $row['email'];
$birthday = $row['birthday'];
$strAddress = isset($row['strAddress']) ? htmlspecialchars($row['strAddress']) : '';
$city = isset($row['city']) ? htmlspecialchars($row['city']) : '';
$state = $row['state'];
$zip = $row['zip'];

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['sub'])) {
    $sql = "UPDATE userInfo SET promotion='1' WHERE username='" . $_SESSION['username'] . "';";
    $conn->query($sql);
}
elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['unsub'])) {
    $sql = "UPDATE userInfo SET promotion='0' WHERE username='" . $_SESSION['username'] . "';";
    $conn->query($sql);
}


?>

<!DOCTYPE>

<head>
    <link href="customer-promotions.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<html>

<body>
    <main>

        <?php include 'elements/header.php' ?>

        <!-- Page Content -->
        <div class="container-fluid text-center">
            <div class="row h-30 content">

                <!-- Side Bar -->
                <div class="col-sm-2 sidenav justify-content-center" style="background-color: #2C6777;">
                    <div class="row align-items-center bottom-margin">
                        <div class="avatarMargin col-1">
                            <div class="row align-items-center d-flex float-right">
                                <img src="https://cdn-icons-png.flaticon.com/512/147/147142.png" width="45px"
                                    height="45px" style="vertical-align: middle;">
                            </div>
                        </div>
                        <div class="col-8 pl-2">
                            <div class="row">
                                <div class="col-12 mt-3 d-flex float-left bottom-margin nowrap">
                                    <h5><?php echo $firstName ?></h5>
                                </div>
                                <div class="col-12 d-flex float-left">
                                    <p>Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: lightgrey">
                    <h4 class="sidebar"><a href="customer-editMyAccount.php">
                            Account Details
                        </a></h4>
                    <h4 class="sidebar"><a href="customer-promotions.php">
                            Promotions
                        </a></h4>
                    <h4 class="sidebar"><a href="customer-logout.php">
                            Logout
                        </a></h4>
                </div>

                <!-- Main Page Portion -->
                <div class="col-sm-10 text-left">
                    <div class="ml-3 mt-5">
                        <h1>Sign Up Today!</h1>
                        <h5 class="pt-2">Want to receive the lastest news and promo codes from LittyLit? Subscribe to
                            our newsletter today!</h5>
                        <div class="row pt-2">
                            <div class="col-sm-6">
                                <form method="post">
                                    <button type="submit" value="1" class="btn btn-primary text-right"
                                        name="sub">Subscribe</button>
                                </form>
                            </div>
                        </div>
                        <h3 class="pt-5">Need to unsubscribe?</h3>
                        <h5 class="pt-2">We hate to see you go.</h5>
                        <div class="row pt-2">
                            <div class="col-sm-6">
                                <form method="post">
                                    <button type="submit" value="0" class="btn btn-primary text-right"
                                        name="unsub">Unsubscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include 'elements/footer.html' ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>