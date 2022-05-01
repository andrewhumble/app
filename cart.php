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

?>

<!DOCTYPE>

<head>
    <link href="cart.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>

        <a href="customer-browseCatalog.php" class="GoBack"><b>
                << Go Back</b></a>

        <div class="Overall">
            <div class="center">
                <div class="picLeft" style="width: 250px;height:250px;">
                    <img class="pic" src="./images/Gatsby.png" alt="Place Holder Book" style="width:150px;height:210px;">
                </div>

                <div class="QMiddle" style="width: 500px;">
                    <h1 class="TitleInfo">The Great Gatsby</h1>
                    <h3 class="AuthorInfo">F. Scott Fitzgerald</h3>
                    <p class="InventoryText"><b>Quantity:</b></p>
                    <select class="Inventory">
                        <option style="font-weight: bolder;" value="Number" selected> 1
                        </option>
                    </select><br><br>
                </div>

                <div class="Price" style="width: 200px;">
                    <h1 class="PriceInfo">$5.00</h1>
                </div>
            </div>

            <div class="center">
                <div class="picLeft" style="width: 250px;height:250px;">
                    <img class="pic" src="./images/HarryPotter.png" alt="Place Holder Book" style="width:150px;height:210px;">
                </div>

                <div class="QMiddle" style="width: 500px;">
                    <h1 class="TitleInfo">Harry Potter and the Sorcerer's Stone</h1>
                    <h3 class="AuthorInfo">J.K. Rowling</h3>
                    <p class="InventoryText"><b>Quantity:</b></p>
                    <select class="Inventory">
                        <option style="font-weight: bolder;" value="Number" selected> 1
                        </option>
                    </select><br><br>
                </div>

                <div class="Price" style="width: 200px;">
                    <h1 class="PriceInfo">$5.00</h1>
                </div>
            </div>

            <div class="order">
                <h1>Order Summary</h1>
                <p>Subtotal: <span>$10.00</span></p>
                <button onclick="window.location.href='#'" class="Checkout">CHECKOUT</button><br>
                <p style="margin-left: 65px;">Apply promotional codes in the next step!</p>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>