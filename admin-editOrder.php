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
    $order_id = $_SESSION['order'];
    $userType = $_SESSION['userType'];
}


$getValuesQuery = "SELECT firstName, lastName, username, order_id, confirmation_id, street, city, state, zip, day_ordered FROM orders WHERE order_id='" . $_SESSION['order'] . "';";

$values = $conn->query($getValuesQuery);
$row = mysqli_fetch_array($values);
$firstName = isset($row['firstName']) ? htmlspecialchars($row['firstName']) : '';
$lastName = isset($row['lastName']) ? htmlspecialchars($row['lastName']) : '';
$username = isset($row['username']) ? htmlspecialchars($row['username']) : '';
$order_id = isset($row['order_id']) ? htmlspecialchars($row['order_id']) : '';
$confirmation_id = isset($row['confirmation_id']) ? htmlspecialchars($row['confirmation_id']) : '';
$street = isset($row['street']) ? htmlspecialchars($row['street']) : '';
$city = isset($row['city']) ? htmlspecialchars($row['city']) : '';
$state = isset($row['state']) ? htmlspecialchars($row['state']) : '';
$zip = isset($row['zip']) ? htmlspecialchars($row['zip']) : '';
$day_ordered = isset($row['day_ordered']) ? htmlspecialchars($row['day_ordered']) : '';

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submitButton"])) {
    
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    $username = $_POST['username'] ? htmlspecialchars($_POST['username']) : '';
    $order_id = $_POST['order_id'] ? htmlspecialchars($_POST['order_id']) : '';
    $confirmation_id = isset($_POST['confirmation_id']) ? htmlspecialchars($_POST['confirmation_id']) : '';
    $street = isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $day_ordered = $_POST['day_ordered'] ? htmlspecialchars($_POST['day_ordered']) : '';
    $sql = "UPDATE orders SET firstName=\"$firstName\",lastName=\"$lastName\", username=\"$username\", order_id = '$order_id', confirmation_id='$confirmation_id', street=\"$street\", city=\"$city\", state=\"$state\", zip=\"$zip\", day_ordered='$day_ordered' WHERE order_id='" . $_SESSION['order'] . "'";
    $conn->query($sql);
    header("Location: admin-searchOrders.php");
}
if (isset($_POST["submitbutton"])) {
    
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
    $username = $_POST['username'] ? htmlspecialchars($_POST['username']) : '';
    $order_id = $_POST['order_id'] ? htmlspecialchars($_POST['order_id']) : '';
    $confirmation_id = isset($_POST['confirmation_id']) ? htmlspecialchars($_POST['confirmation_id']) : '';
    $street = isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '';
    $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $day_ordered = $_POST['day_ordered'] ? htmlspecialchars($_POST['day_ordered']) : '';

    $sql = "DELETE FROM orders WHERE order_id='".$_SESSION['order']."' ";
    $conn->query($sql);
    header("Location: admin-searchOrders.php");
    
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
    <?php include 'elements/header.php' ?>
        <div class="container-fluid text-center">
            <div class="row h-30 justify-content-center">
            <form method="post">
                <div class="col-9 pt-4 mx-auto justify-content-center">
                    <div class="row justify-content-center">
                        <h1>Order #<?php echo $order_id ?> Information</h1>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-sm-6">
                            <label class="float-left">First Name</label>
                            <input style="font-family: Nunito" type="text" name = 'firstName' class="form-control" value="<?php echo $firstName ?>">
                        </div>
                        <div class="col-sm-6 justify-content-center">
                            <label class="float-left">Last Name</label>
                            <input style="font-family: Nunito" type="text" name = 'lastName' class="form-control" value="<?php echo $lastName ?>">
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-sm-12">
                            <label class="float-left">Username</label>
                            <input style="font-family: Nunito" type="text" name = 'username' class="form-control" value="<?php echo $username ?>">
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-sm-4">
                            <label class="float-left">Order ID</label>
                            <input style="font-family: Nunito" type="text" name = 'order_id' class="form-control" value="<?php echo $order_id ?>">
                        </div>
                        <div class="col-sm-4">
                            <label class="float-left">Confirmation Number</label>
                            <input style="font-family: Nunito" type="text" name = 'confirmation_id' class="form-control" value="<?php echo $confirmation_id ?>">
                        </div>
                        <div class="col-sm-4">
                            <label class="float-left">Date Ordered</label>
                            <input style="font-family: Nunito" type="text" name = 'day_ordered' class="form-control" value="<?php echo $day_ordered ?>">
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-sm-12">
                            <label class="float-left">Shipping Address</label>
                            <input style="font-family: Nunito" type="text" name = 'street' class="form-control" value="<?php echo $street ?>">
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-sm-5">
                            <label class="float-left">City</label>
                            <input style="font-family: Nunito" type="text" name='city' class="form-control" value="<?php echo $city ?>">
                        </div>
                        <div class="col-sm-2">
                            <label class="float-left">State</label>
                            <input style="font-family: Nunito" type="text" name='state' class="form-control" value="<?php echo $state ?>">
                        </div>
                        <div class="col-sm-5">
                            <label class="float-left">Zip Code</label>
                            <input style="font-family: Nunito" type="text" name='zip' class="form-control" value="<?php echo $zip ?>">
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-center">
                        <div class="col-6">
                        <button style="background-color: transparent; color: black; text-decoration: underline; border: 0px;" name="submitbutton" type="submit" class="btn btn-primary pr-6">Delete Order</button>
                        </div>
                        <div class="col-6 justify-content-center">
                        <button style="background-color: #2B6777; border: 0px;" name="submitButton" type="submit" class="btn btn-primary pr-6">Save Changes</button>
                        </div>
                    </div>
                </form>
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