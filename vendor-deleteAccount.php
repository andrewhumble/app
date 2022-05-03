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

if ($_SESSION['userType'] != 2) {
    header("Location: home.php");
}

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}
###########

$getValuesQuery = "SELECT firstName, lastName, email, birthday, strAddress, city, state, zip FROM userInfo WHERE username='" . $_SESSION['username'] . "';";

$values = $conn->query($getValuesQuery);
$row = $values->fetch_assoc();

$firstName = isset($row['firstName']) ? htmlspecialchars($row['firstName']) : '';
$lastName = isset($row['lastName']) ? htmlspecialchars($row['lastName']) : '';
$email = $row['email'];
$birthday = $row['birthday'];
$strAddress = isset($row['strAddress']) ? htmlspecialchars($row['strAddress']) : '';
$city = isset($row['city']) ? htmlspecialchars($row['city']) : '';
$state = $row['state'];
$zip = $row['zip'];

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submitButton"])) {

    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    $email = $_POST['email'] ? htmlspecialchars($_POST['email']) : '';
    $birthday = $_POST['birthday'] ? htmlspecialchars($_POST['birthday']) : '';
    $strAddress = isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = $_POST['state'] ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $sql = "UPDATE userInfo SET firstName=\"$firstName\",lastName=\"$lastName\", email='$email', birthday='$birthday', strAddress=\"$strAddress\", city=\"$city\", state='$state', zip='$zip' WHERE username='" . $_SESSION['username'] . "'";
    $conn->query($sql);
}
if (isset($_POST["submitbutton"])) {

    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    $email = $_POST['email'] ? htmlspecialchars($_POST['email']) : '';
    $birthday = $_POST['birthday'] ? htmlspecialchars($_POST['birthday']) : '';
    $strAddress = isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = $_POST['state'] ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $sql = "DELETE FROM book WHERE username='" . $_SESSION['username'] . "' ";
    echo $sql;
    $conn->query($sql);
    $sql = "DELETE FROM userInfo WHERE username='" . $_SESSION['username'] . "' ";
    echo $sql;
    $conn->query($sql);
    $_SESSION = array();
    session_destroy();
    header('Location: welcome.html');
}
?>

<!DOCTYPE>

<head>
    <link href="userLogout.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>
<html>

<body>
    <main>
        <?php include 'elements/header.php' ?>
        <div class="container-fluid text-center">
            <div class="row h-30 content">
                <div class="col-sm-2 sidenav justify-content-center" style="background-color: #2C6777;">
                    <div class="row align-items-center bottom-margin">
                        <div class="avatarMargin col-1">
                            <div class="row align-items-center d-flex float-right">
                                <img src="https://cdn-icons-png.flaticon.com/512/147/147142.png" width="45px" height="45px" style="vertical-align: middle;">
                            </div>
                        </div>
                        <div class="col-8 pl-2">
                            <div class="row">
                                <div class="col-12 mt-3 d-flex float-left bottom-margin nowrap">
                                    <h5><?php echo $firstName ?></h5>
                                </div>
                                <div class="col-12 d-flex float-left">
                                    <p>Vendor </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: lightgrey">
                    <h4 class="sidebar"><a href="vendor-editMyAccount.php">
                            Account Details
                        </a></h4>
                    <h4 class="sidebar"><a href="vendor-logout.php">
                            Logout
                        </a></h4>
                </div>
                <div class="row">
                    <div class="col-sm-10 text-left">
                        <div class="ml-3 mt-5">
                            <h1 style="font-family: Nunito; color: #3F3D56">Hi <?php echo $firstName ?>, we are sorry to
                                hear you'd like to delete your account.</h1>
                            <h3 style="font-family: Nunito; color: #3F3D56"></h3>
                        </div>
                        <div class="ml-3 mt-5">
                            <form method="post">
                                <button style="background-color: #C8D8E4; border: 5px solid #C8D8E4; font-family: Nunito; color: #3F3D56;" class="btn btn-primary" type="submit" name="submitbutton"><strong>Delete My
                                        Account</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'elements/footer.html'; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>