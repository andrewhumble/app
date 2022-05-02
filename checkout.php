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

$promotion = "";
$method = "card";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['radio'])) {
        $method = $_POST['radio'];
    }

    if (isset($_POST['promotion'])) {
        $promotion = $_POST['promotion'];

        $promoQuery = "SELECT * FROM promotions WHERE name='$promotion';";
        $promoResult = $conn->query($promoQuery);
        $promo = mysqli_fetch_array($promoResult);

        if (mysqli_num_rows($promoResult) != 0) {
            $promotion = $promo['discount'];
        }
    }
}

?>

<!DOCTYPE>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href="checkout.css" rel="stylesheet">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<html>

<body>
    <main>
        <?php include 'elements/header.php' ?>

        <div class="row">
            <div class="col-8" style="padding-left: 5rem !important;">
                <div class="row pt-5">
                    <a style="text-decoration: underline !important; color: #3F3D56" href="cart.php">
                        <b class="goback">
                            << Go Back</b></a>
                </div>
                <div class="row pt-4 pl-3">
                    <h3>Payment Method</h3>
                </div>
                <form method="post">
                    <div class="form-check form-check-inline">
                        <?php if ($method == "card") { ?>
                            <input onchange="this.form.submit();" class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="card" style="box-shadow: none !important;" checked>
                        <?php } else { ?>
                            <input onchange="this.form.submit();" class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="card" style="box-shadow: none !important;">
                        <?php } ?>
                        <label class=" form-check-label" for="inlineRadio1">Pay By Card</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <?php if ($method == "instore") { ?>
                            <input onchange="this.form.submit();" class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="instore" style="box-shadow: none !important;" checked>
                        <?php } else { ?>
                            <input onchange="this.form.submit();" class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="instore" style="box-shadow: none !important;">
                        <?php } ?>
                        <label class="form-check-label" for="inlineRadio2">Pay In-Store</label>
                    </div>
                </form>
                <?php if ($method == "card") { ?>
                    <div class="pt-2 row">
                        <div class="col-12">
                            <div class="pt-2 form-group">
                                <label for="firstName">Card Number</label>
                                <input type="text" placeholder="1111 1111 1111 1111" class="form-control" id="cardNum" name="cardNum" required>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 row">
                        <div class="col-4">
                            <div class="pt-2 form-group">
                                <label for="firstName">Exp. Date</label>
                                <input type="text" placeholder="11/24" class="form-control" id="exp" name="exp" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="pt-2 form-group">
                                <label for="firstName">Security Code</label>
                                <input type="text" placeholder="111" class="form-control" id="sec" name="sec" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="pt-2 form-group">
                                <label for="firstName">Zip Code</label>
                                <input type="text" placeholder="11111" class="form-control" id="zip" name="zip" required>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="pt-2 row justify-content-center">
                        <div class="col-12 t-2 form-group">
                            <label for="address">Street Address</label>
                            <input type="text" placeholder="Street Address" class="form-control" id="strAddress" name="strAddress" required>
                        </div>
                    </div>
                    <div class="pt-2 mb-4 row justify-content-center">
                        <div class="col-5">
                            <div class="pt-2 form-group">
                                <label for="city">City</label>
                                <input type="text" placeholder="City" class="form-control" id="city" name="city" required>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="pt-2 form-group">
                                <label for="state">State</label>
                                <input type="text" placeholder="GA" class="form-control" id="state" name="state" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="pl-2 pt-2 form-group">
                                <label for="password">Zip Code</label>
                                <input type="text" placeholder="Zip" class="form-control" id="zip" name="zip" required>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="pt-2 row justify-content-center">
                        <div class="col-12 t-2 form-group">
                            <p>Pick up in-store at your nearest store in the next 5 days.</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-3 pl-4" style="margin-left: 5rem; background-color: #2B6777; height: 30%;">
                <div class="row mt-4 justify-content-center">
                    <h3 style="color: white !important">Order Summary</h3>
                </div>
                <hr style="background-color: lightgrey" />

                <div class="row mt-4 ml-3">
                    <div class='col text-left'>
                        <h5 style="color: white !important; font-size: 1.1rem;">Subtotal:</h5>
                        <h5 style="color: white !important; font-size: 1.1rem;">Tax:</h5>
                        <?php if ($promotion != "") {
                            echo "<h5 style='color: white !important; font-size: 1.1rem;'>Promotion:</h5>";
                        } ?>
                        <h5 class="pt-4" style="color: white !important; font-size: 1.3rem;">Total:</h5>
                    </div>
                    <div class='col text-right'>
                        <h5 style="color: white !important; font-size: 1.1rem;"><?php echo "$" . number_format($sum['SUM(price*quantity)'], 2) ?></h5>
                        <?php if ($promotion != "") {
                        ?>
                            <h5 style="color: white !important; font-size: 1.1rem;"><?php echo "$" . number_format($sum['SUM(price*quantity)'] * 0.07, 2) ?></h5>
                            <h5 style='color: white !important; font-size: 1.1rem;'><?php echo "-$" . number_format($promo['discount'] * ($sum['SUM(price*quantity)'] + $sum['SUM(price*quantity)'] * 0.07), 2) ?></h5>
                            <h5 class="pt-4" style="color: white !important; font-size: 1.5rem;"><b><?php echo "$" . number_format((1 - $promo['discount']) * ($sum['SUM(price*quantity)'] + $sum['SUM(price*quantity)'] * 0.07), 2) ?></b></h5>
                        <?php } else { ?>
                            <h5 style="color: white !important; font-size: 1.1rem;"><?php echo "$" . number_format($sum['SUM(price*quantity)'] * 0.07, 2) ?></h5>
                            <h5 class="pt-4" style="color: white !important; font-size: 1.5rem;"><b><?php echo "$" . number_format($sum['SUM(price*quantity)'] + $sum['SUM(price*quantity)'] * 0.07, 2) ?></b></h5>
                        <?php } ?>
                    </div>
                </div>
                <hr style="background-color: lightgrey" />

                <div class="row ml-3 mr-3">
                    <h5 style="color: white !important; font-size: 1rem;"><b>Promotional Code</b></h5>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="" name="promotion">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" style="background-color: lightgrey; border-color: lightgrey;" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row mt-5 justify-content-center">
                    <?php
                    if (mysqli_num_rows($values) != 0) { ?>
                        <button onclick="location.href='customer-confirmation.php'" class="btn" style="border-radius: 1rem 1rem; padding: 0rem 5rem; background-color: #C8D8E4">
                            <p class="pt-3" style="color: #2B6777; font-weight: bold; font-size: 1.2rem;">Place Holder</p>
                        </button>
                    <?php } else { ?>
                        <button onclick="location.href='customer-confirmation.php'" class="btn" style="border-radius: 1rem 1rem; padding: 0rem 5reml; background-color: #C8D8E4" disabled>
                            <p class="pt-3" style="color: #2B6777; font-weight: bold; font-size: 1.2rem;">Place Order</p>
                        </button>
                    <?php } ?>
                </div>
                <div class="row justify-content-center mt-4">
                </div>
            </div>
        </div>

        <?php include 'elements/footer.html' ?>
    </main>
</body>

</html>