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
    $username = $_SESSION['user'];
    $userType = $_SESSION['userType'];
}
###########

$getValuesQuery = "SELECT firstName, lastName, email, birthday, strAddress, city, state, zip FROM userInfo WHERE username='" . $_SESSION['user'] . "';";

$values = $conn->query($getValuesQuery);
$row = $values->fetch_assoc();

$firstName = isset($row['firstName']) ? htmlspecialchars($row['firstName']) : '';
$lastName = isset($row['lastName']) ? htmlspecialchars($row['lastName']) : '';
//$password = $row['password'];
$email = $row['email'];
$birthday = $row['birthday'];
$strAddress = isset($row['strAddress']) ? htmlspecialchars($row['strAddress']) : '';
$city = isset($row['city']) ? htmlspecialchars($row['city']) : '';
$state = $row['state'];
$zip = $row['zip'];

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submitButton"])) {

    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    //$password = $_POST['password'];
    $email = $_POST['email'] ? htmlspecialchars($_POST['email']) : '';
    $birthday = $_POST['birthday'] ? htmlspecialchars($_POST['birthday']) : '';
    $strAddress = isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = $_POST['state'] ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $sql = "UPDATE userInfo SET firstName=\"$firstName\",lastName=\"$lastName\", email='$email', birthday='$birthday', strAddress=\"$strAddress\", city=\"$city\", state='$state', zip='$zip' WHERE username='" . $_SESSION['user'] . "'";
    $conn->query($sql);
}
if (isset($_POST["submitbutton"])) {

    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    //$password = $_POST['password'];
    $email = $_POST['email'] ? htmlspecialchars($_POST['email']) : '';
    $birthday = $_POST['birthday'] ? htmlspecialchars($_POST['birthday']) : '';
    $strAddress = isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = $_POST['state'] ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $sql = "DELETE FROM userInfo WHERE username='" . $_SESSION['user'] . "' ";
    $conn->query($sql);
    header("Location: search_user.php");
    
}

?>

<!DOCTYPE>

<head>
    <link href="admin-editUserAccount.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<html>

<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pl-4" href="home.php" style="font-size: 60px; color: #3F3D56">LittyLit</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav d-lg-flex align-items-center mt-3">
                    <a class="nav-item h-100 nav-link" href="search_order.php">
                        <h5>Search Orders</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="search_user.php">
                        <h5>Search Users</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="view.php">
                        <h5>Search Books</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="admin-myAccount.php">
                        <h5>My Account</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="admin-reports.php">
                        <h5>Reports</h5>
                    </a>
                </div>
            </div>
        </nav>

        <div class="container-fluid text-center">
            <div class="row h-30 content">
                <form method="post">
                    <div class="col-sm-9 pt-5 mx-auto">
                        <div class="row">
                            <h1><?php echo $firstName ?>'s Account</h1>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class="float-left">First Name</label>
                                <input type="text" name='firstName' class="form-control" value="<?php echo $firstName ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="float-left">Last Name</label>
                                <input type="text" name='lastName' class="form-control" value="<?php echo $lastName ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="float-left">Email</label>
                                <input type="text" name='email' class="form-control" value="<?php echo $email ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <label class="float-left">Birthday</label>
                                <input type="text" name='birthday' class="form-control" value="<?php echo $birthday ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="float-left">Shipping Address</label>
                                <input type="text" name='strAddress' class="form-control" value="<?php echo $strAddress ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-5">
                                <label class="float-left">City</label>
                                <input type="text" name='city' class="form-control" value="<?php echo $city ?>">
                            </div>
                            <div class="col-sm-2">
                                <label class="float-left">State</label>
                                <input type="text" name='state' class="form-control" value="<?php echo $state ?>">
                            </div>
                            <div class="col-sm-5">
                                <label class="float-left">Zip Code</label>
                                <input type="text" name='zip' class="form-control" value="<?php echo $zip ?>">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-sm-6">
                                <!-- <a class="deleteAcc float-left" href=""><u>Delete Account</u></a> -->
                                <button name="submitbutton" type="submit" class="btn btn-primary pr-6">Delete Account</button>
                            </div>
                            <div class="col-sm-6">
                                <!-- <input class="submit float-right" type="submit" value="Save Changes" name="submitButton"> -->
                                <button name="submitButton" type="submit" class="btn btn-primary pr-6">Save Changes</button>
                            </div>
                        </div>
                        <!-- <div class="col-sm-5">
                            <label class="float-left">Zip Code</label>
                            <input type="text" name='zip' class="form-control" value="<?php echo $zip ?>">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-6"> -->
                            <!-- <a class="deleteAcc float-left" href=""><u>Delete Account</u></a> -->
                            
                            <!-- <button name="submitbutton" type="submit" class="btn btn-primary pr-6">Delete Account</button>
                        </div>
                        <div class="col-sm-6"> -->
                            <!-- <input class="submit float-right" type="submit" value="Save Changes" name="submitButton"> -->
                            
                            <!-- <button name="submitButton" type="submit" class="btn btn-primary pr-6">Save Changes</button>
                        </div>
                    </div> -->
                    </form>
                </div>
            </div>
        </div>
        </div>

        <footer class="footer pl-4">
            <p>CSCI 4050 Final Project by Andrew Humble, Elodie Collier, Nisha Rajendra, and Manmeet Gill.</p>
        </footer>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>