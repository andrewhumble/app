<?php
require_once('connDB.php');
// Check connection
if ($conn == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start();

require_once('connDB.php');

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
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

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submitButton'])) {
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    $password = $_POST['password'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $strAddress = isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $sql = "UPDATE userInfo SET firstName=\"$firstName\",lastName=\"$lastName\", password='$password', email='$email', birthday='$birthday', strAddress=\"$strAddress\", city=\"$city\", state='$state', zip='$zip' WHERE username='" . $_SESSION['username'] . "'";
    $conn->query($sql);
}

?>

<!DOCTYPE>

<head>
    <link href="editMyAccount.css" rel="stylesheet">
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
                                    <p>Administrator</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: lightgrey">
                    <h4 class="sidebar"><a href="admin-editMyAccount.php">
                            Account Details
                        </a></h4>
                    <h4 class="sidebar"><a href="admin-logout.php">
                            Logout
                        </a></h4>
                </div>
                <div class="col-sm-10 text-left">
                    <form method="post">
                        <div class="ml-4 mt-5">
                            <h1>Welcome, <?php echo $firstName ?>!</h1>
                            <div class="pt-2 row">
                                <div class="col-4">
                                    <div class="pt-2 form-group">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="pl-2 pt-2 form-group">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2 row">
                                <div class="col-8 t-2 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value=<?php echo $email ?> required>
                                </div>
                            </div>
                            <div class="pt-2 row">
                                <div class="col-4 t-2 form-group">
                                    <div class="pt-2 form-group">
                                        <label for="username">Birthday</label>
                                        <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="birthday" name="birthday" value=<?php echo $birthday ?> required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="pl-2 pt-2 form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value=<?php echo $password ?> required minlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mr-2">
                            <div class="col-8 pr-6 mt-2 text-right">
                                <button name="submitButton" type="submit" class="btn btn-primary pr-6">Save Changes</button>
                            </div>
                        </div>
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