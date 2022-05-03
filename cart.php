<?php
session_start();

if ($_SESSION['userType'] != 1) {
    header("Location: home.php");
}

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

$getBooksQuery = "SELECT username, title, author, price, ISBN, quantity, stock, imgPath FROM cart WHERE username='$username';";
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
    <link href="cart.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>

        <div class="row" style="margin-bottom: 5rem;">
            <div class="col-8">
                <div class="row">
                    <a href="customer-browseCatalog.php" class="GoBack"><b>
                            << Go Back</b></a>
                </div>

                <div class="Overall">
                    <?php
                    if (mysqli_num_rows($values) == 0) { ?>
                        <div class="pl-5 pt-3" style="height: 11rem; margin-left: 3rem;">
                            <h3 class="mt-4">Your cart is empty! <a href="customer-browseCatalog.php" style="color:#2B6777 "> Click here </a> to browse the catalog.</h3>
                        </div>
                    <?php }
                    ?>
                    <?php while ($row = mysqli_fetch_array($values)) { ?>
                        <div class="center">
                            <div class="picLeft" style="width: 250px;height:250px;">
                                <img class="pic" src="<?php echo $row['imgPath'] ?>" alt="Place Holder Book" style="width:150px;height:210px;">
                            </div>

                            <div class="QMiddle" style="width: 500px;">
                                <h1 class="TitleInfo mt-4"><?php echo $row['title'] ?></h1>
                                <h3 class="AuthorInfo mb-4"><?php echo $row['author'] ?></h3>
                                <p class="InventoryText"><b>Quantity:</b></p>
                                <form method="post">
                                    <select class="form-select mt-2" style="border-radius: 0.3rem; border-color: white;" name="select" onchange="this.form.submit()">
                                        <?php for ($i = 1; $i <= $row['stock']; $i++) {
                                            if ($i == $row['quantity']) { ?>
                                                <option style="font-weight: bolder;" value="<?php echo $i ?>|<?php echo $row['ISBN'] ?>" selected> <?php echo $i ?>
                                                </option>
                                            <?php } else { ?>
                                                <option style="font-weight: bolder;" value="<?php echo $i ?>|<?php echo $row['ISBN'] ?>"> <?php echo $i ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select><br><br>
                                </form>
                                <a href="cart.php?remove=<?php echo $row['ISBN'] ?>">
                                    <p>Remove Book</p>
                                </a>
                                <?php
                                if (isset($_POST["select"])) {
                                    $select = $_POST['select'];

                                    $result_explode = explode('|', $select);
                                    $quantity = $result_explode[0];
                                    $isbn =  $result_explode[1];

                                    $sumQuery = "SELECT SUM(price*quantity) FROM cart WHERE username='$username';";
                                    $sumResult = $conn->query($sumQuery);
                                    $sum = mysqli_fetch_array($sumResult);

                                    $addToCartQuery = "UPDATE cart SET quantity=$quantity WHERE ISBN='$isbn' AND username='$username';";
                                    $conn->query($addToCartQuery);

                                    # header("Refresh:0");
                                }
                                ?>
                            </div>

                            <div class="Price mt-4 mr-2" style="width: 200px;">
                                <h1 class="PriceInfo"><?php echo "$" . number_format($row['price'], 2) ?></h1>
                            </div>

                        </div>

                    <?php } ?>
                </div>
            </div>

            <div class="col-3 pl-4" style="margin-left: 5rem; background-color: #2B6777; height: 30%;">
                <div class="row mt-4 justify-content-center">
                    <h3 style="color: white !important">Order Summary</h3>
                </div>
                <hr />

                <div class="row mt-4 ml-3">
                    <h5 style="color: white !important; font-size: 1.3rem;">Subtotal: <b><?php echo "$" . number_format($sum['SUM(price*quantity)'], 2) ?></b></h5>
                </div>
                <div class="row mt-4 justify-content-center">
                    <?php
                    if (mysqli_num_rows($values) != 0) { ?>
                        <button onclick="location.href='checkout.php'" class="btn" style="border-radius: 1rem 1rem; padding: 0.7rem 5rem">
                            <p style="color: #2B6777; font-weight: bold; font-size: 1.2rem;">Checkout</p>
                        </button>
                    <?php } else { ?>
                        <button onclick="location.href='checkout.php'" class="btn" style="border-radius: 1rem 1rem; padding: 0.7rem 5rem" disabled>
                            <p style="color: #2B6777; font-weight: bold; font-size: 1.2rem;">Checkout</p>
                        </button>
                    <?php } ?>
                </div>
                <div class="row justify-content-center mt-2">
                    <p style="color: white !important; font-size: 0.9rem !important;">Apply promotional codes in the next step!</p>
                </div>
            </div>
        </div>

        <!-- <div class="order">
            <h1>Order Summary</h1>
            <p>Subtotal: <span>$10.00</span></p>
            <button onclick="window.location.href='#'" class="Checkout">CHECKOUT</button><br>
            <p style="margin-left: 65px;">Apply promotional codes in the next step!</p>
        </div>
        </div> -->

        <?php include 'elements/footer.html' ?>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>