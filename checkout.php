<?php
session_start();

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

$getBooksQuery = "SELECT username, title, author, price, ISBN, quantity, stock, imgPath FROM cart;";
$values = $conn->query($getBooksQuery);

$sumQuery = "SELECT SUM(price*quantity) FROM cart WHERE username='$username';";
$sumResult = $conn->query($sumQuery);
$sum = mysqli_fetch_array($sumResult);

$remove = "";
isset($_POST['remove']) ? $remove = $_POST['remove'] : ($remove = $_GET['remove'] ?? "");

if ($remove != "") {
    $removeQuery = "DELETE FROM cart WHERE username='$username' AND ISBN='$remove';";
    $conn->query($removeQuery);
    header("Location: cart.php");
}

?>

<!DOCTYPE>

<head>
    <link href="checkout.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<html>

<body>
    <main>
        <?php include 'elements/header.php' ?>

        <div class="row">
            <div class="ml-4 col-8">

                <div class="shippingDiv">
                    <div class="row">
                        <a class="goBackLink" href="">&lt;&lt;Go Back</a>
                    </div>
                    <div class="row">
                        <h3>Shipping</h3>
                    </div>
                    <form class="orderInfoDiv">
                        <p class="addressLabel">Street Address</p> <br>
                        <input class="addressInput" type="address" id="email" name="address"><br><br>

                        <p class="cityLabel">City</p>
                        <p class="stateLabel">State</p>
                        <p class="zipLabel">Zip Code</p> <br>

                        <input class="cityInput" type="text" id="city" name="city">
                        <input class="stateInput" type="text" id="state" name="state">
                        <input class="zipInput" type="text" id="zip" name="zip"> <br><br>

                        <p class="firstNameLabel">First Name</p>
                        <p class="lastNameLabel">Last Name</p> <br>

                        <input class="nameInput" type="text" id="fname" name="fname">
                        <input class="nameInput" type="text" id="lname" name="fname"> <br>

                        <p class="emailLabel">Email</p> <br>
                        <input class="emailInput" type="email" id="email" name="email"><br><br>

                        <hr class="orderLine">

                        <h1 class="paymentMethod">Payment Method</h1>
                        <input type="radio" id="debit" name="payment">
                        <label class="radioLabel" for="customer">Debit</label>
                        <input type="radio" id="credit" name="payment">
                        <label class="radioLabel" for="customer">Credit</label>
                        <input type="radio" id="in-store" name="payment">
                        <label class="radioLabel" for="customer">In-Store</label> <br><br>

                        <p class="emailLabel">Card Number</p> <br>
                        <input class="emailInput" type="cardNumb" id="cardNumb" name="cardNumb"><br><br>

                        <p class="cvvLabel">CVV</p>
                        <p class="payZipLabel">Zip Code</p> <br>

                        <input class="nameInput" type="text" id="fname" name="fname">
                        <input class="nameInput" type="text" id="lname" name="fname"> <br>

                        <h5>*If you have chosen the "Pay at Store" option, you will have up to 5 days to pick up your books at a LittyLit store location.</h5>
                    </form>
                </div>
            </div>

            <div class="col-3">
                <div class="orderSumDiv">
                    <h2>Order Summary</h2>
                    <h3>Subtotal:</h3>
                    <h3 class="subtotal">$10.00</h3> <br>
                    <h3>Tax:</h3>
                    <h3 class="tax">$0.70</h3> <br>
                    <h3>Promotion:</h3>
                    <h3 class="promo">-$5.35</h3> <br>
                    <h3>Total:</h3>
                    <h3 class="total">$5.35</h3>
                    <hr class="promoLine">
                    <form class="promotionForm" action="">
                        <label for="pCode">Promotional Code</label><br>
                        <input class="promoSubmit" type="text" name="pCode"><br>
                        <input type="submit" value="PLACE ORDER"><br>
                    </form>
                </div>
            </div>
        </div>

    </main>
</body>

</html>