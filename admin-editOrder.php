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
    $order_id = $_SESSION['order'];
    $userType = $_SESSION['userType'];
}
###########

$getValuesQuery = "SELECT firstName, lastName, username, order_id, confirmation_id, street, city, state, zip, day_ordered FROM orders WHERE order_id='" . $_SESSION['order'] . "';";

$values = $conn->query($getValuesQuery);
$row = mysqli_fetch_array($values);
//$id = $row['id'];
$firstName = isset($row['firstName']) ? htmlspecialchars($row['firstName']) : '';
$lastName = isset($row['lastName']) ? htmlspecialchars($row['lastName']) : '';
//$password = $row['password'];
$username = isset($row['username']) ? htmlspecialchars($row['username']) : '';
$order_id = isset($row['order_id']) ? htmlspecialchars($row['order_id']) : '';
$confirmation_id = isset($row['confirmation_id']) ? htmlspecialchars($row['confirmation_id']) : '';
$street = isset($row['street']) ? htmlspecialchars($row['street']) : '';
$city = isset($row['city']) ? htmlspecialchars($row['city']) : '';
$state = isset($row['state']) ? htmlspecialchars($row['state']) : '';
$zip = isset($row['zip']) ? htmlspecialchars($row['zip']) : '';
$day_ordered = isset($row['day_ordered']) ? htmlspecialchars($row['day_ordered']) : '';

//echo $getValuesQuery;

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submitButton"])) {
    
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    //$password = $_POST['password'];
    $username = $_POST['username'] ? htmlspecialchars($_POST['username']) : '';
    $order_id = $_POST['order_id'] ? htmlspecialchars($_POST['order_id']) : '';
    $confirmation_id = isset($_POST['confirmation_id']) ? htmlspecialchars($_POST['confirmation_id']) : '';
    $street = isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $day_ordered = $_POST['day_ordered'] ? htmlspecialchars($_POST['day_ordered']) : '';
    $sql = "UPDATE orders SET firstName=\"$firstName\",lastName=\"$lastName\", username=\"$username\", order_id = '$order_id', confirmation_id='$confirmation_id', street=\"$street\", city=\"$city\", state=\"$state\", zip=\"$zip\", day_ordered='$day_ordered' WHERE order_id='" . $_SESSION['order'] . "'";
    echo $sql;
    $conn->query($sql);
}
if (isset($_POST["submitbutton"])) {
    
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    //$password = $_POST['password'];
    $username = $_POST['username'] ? htmlspecialchars($_POST['username']) : '';
    $order_id = $_POST['order_id'] ? htmlspecialchars($_POST['order_id']) : '';
    $confirmation_id = isset($_POST['confirmation_id']) ? htmlspecialchars($_POST['confirmation_id']) : '';
    $street = isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $day_ordered = $_POST['day_ordered'] ? htmlspecialchars($_POST['day_ordered']) : '';
    
    //$zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $sql = "DELETE FROM orders WHERE order_id='".$_SESSION['order']."' ";
    $conn->query($sql);
    header("Location: search_order.php");
    
}

?>

<!DOCTYPE>

<head>
    <link href="admin-editOrder.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<html>

<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pl-4" href="#" style="font-size: 60px; color: #3F3D56">LittyLit</a>
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
                <div class="col-sm-9 pt-4 mx-auto">
                    <div class="row">
                        <h1>Order #<?php echo $order_id ?> Information</h1>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <label class="float-left">First Name</label>
                            <input type="text" name = 'firstName' class="form-control" value="<?php echo $firstName ?>">
                        </div>
                        <div class="col-sm-6">
                            <label class="float-left">Last Name</label>
                            <input type="text" name = 'lastName' class="form-control" value="<?php echo $lastName ?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <label class="float-left">Username</label>
                            <input type="text" name = 'username' class="form-control" value="<?php echo $username ?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <label class="float-left">Order ID</label>
                            <input type="text" name = 'order_id' class="form-control" value="<?php echo $order_id ?>">
                        </div>
                        <div class="col-sm-4">
                            <label class="float-left">Confirmation Number</label>
                            <input type="text" name = 'confirmation_id' class="form-control" value="<?php echo $confirmation_id ?>">
                        </div>
                        <div class="col-sm-4">
                            <label class="float-left">Date Ordered</label>
                            <input type="text" name = 'day_ordered' class="form-control" value="<?php echo $day_ordered ?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <label class="float-left">Shipping Address</label>
                            <input type="text" name = 'street' class="form-control" value="<?php echo $street ?>">
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
                        <button name="submitbutton" type="submit" class="btn btn-primary pr-6">Delete Order</button>
                        </div>
                        <div class="col-sm-6">
                        <button name="submitButton" type="submit" class="btn btn-primary pr-6">Save Changes</button>
                        </div>
                    </div>
                </form>
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

/Applications/XAMPP/xamppfiles/htdocs/LittyLit/app/admin-editOrder.php