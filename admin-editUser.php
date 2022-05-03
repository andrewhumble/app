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


session_start();

//connect to database
require_once('connDB.php');

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

$getValuesQuery = "SELECT firstName, lastName, email, birthday, strAddress, city, state, zip FROM userInfo WHERE username='" . $_SESSION['user'] . "';";

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
    $sql = "UPDATE userInfo SET firstName=\"$firstName\",lastName=\"$lastName\", email='$email', birthday='$birthday', strAddress=\"$strAddress\", city=\"$city\", state='$state', zip='$zip' WHERE username='" . $_SESSION['user'] . "'";
    $conn->query($sql);
    header("Location: admin-searchUsers.php");
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
    $sql = "DELETE FROM book WHERE username='" . $_SESSION['user'] . "' ";
    echo $sql;
    $conn->query($sql);
    $sql = "DELETE FROM userInfo WHERE username='" . $_SESSION['user'] . "' ";
    echo $sql;
    $conn->query($sql);
    header("Location: admin-searchUsers.php");
    
}

?>

<!DOCTYPE>

<head>
    <link href="#" rel="stylesheet">
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
            <div class="row h-30 justify-content-center">
                <form method="post">
                    <div class="col-sm-9 pt-5 mx-auto">
                        <div class="row justify-content-center">
                            <h1 style="font-family: Nunito; color: #3F3D56"><strong><?php echo $firstName ?>'s
                                    Account</strong></h1>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">First Name</label>
                                <input style="font-family: Nunito" type="text" name='firstName' class="form-control"
                                    value="<?php echo $firstName ?>">
                            </div>
                            <div class="col-sm-6">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">Last Name</label>
                                <input style="font-family: Nunito" type="text" name='lastName' class="form-control"
                                    value="<?php echo $lastName ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">Email</label>
                                <input style="font-family: Nunito" type="text" name='email' class="form-control"
                                    value="<?php echo $email ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">Birthday</label>
                                <input style="font-family: Nunito" type="text" name='birthday' class="form-control"
                                    value="<?php echo $birthday ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">Shipping
                                    Address</label>
                                <input style="font-family: Nunito" type="text" name='strAddress' class="form-control"
                                    value="<?php echo $strAddress ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-5">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">City</label>
                                <input style="font-family: Nunito" type="text" name='city' class="form-control"
                                    value="<?php echo $city ?>">
                            </div>
                            <div class="col-sm-2">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">State</label>
                                <input style="font-family: Nunito" type="text" name='state' class="form-control"
                                    value="<?php echo $state ?>">
                            </div>
                            <div class="col-sm-5">
                                <label style="font-family: Nunito; color: #3F3D56" class="float-left">Zip Code</label>
                                <input style="font-family: Nunito" type="text" name='zip' class="form-control"
                                    value="<?php echo $zip ?>">
                            </div>
                        </div>
                        <div class="row mt-5 justify-content-center">
                            <div class="col-6">
                                <button
                                    style="background-color: transparent; color: black; text-decoration: underline; border: 0px;"
                                    name="submitbutton" type="submit" class="btn btn-primary pr-6">Delete User</button>
                            </div>
                            <div class="col-6 justify-content-center">
                                <button style="background-color: #2B6777; border: 0px;" name="submitButton"
                                    type="submit" class="btn btn-primary pr-6 mb-5">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include 'elements/footer.html'; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>