<?php
session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 1) {
    header("Location: home.php");
}

$userType = 1;

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = 1;
}

isset($_POST['selectedBook']) ? $selectedBook = $_POST['selectedBook'] : $selectedBook = $_GET['selectedBook'];

$getBooksQuery = "SELECT username, title, author, price, genre, ISBN, stock, imgPath FROM book WHERE ISBN=$selectedBook;";
$values = $conn->query($getBooksQuery);
$row = mysqli_fetch_array($values);

# Check if book is already in cart

$getCartQuery = "SELECT * FROM cart WHERE ISBN='$selectedBook' AND username='$username';";
$cartValues = $conn->query($getCartQuery);
$cartRow = mysqli_fetch_array($cartValues);

$button = "<p class='pb-5' style='color: white;'>Add to Cart</p>";

if (mysqli_num_rows($cartValues) > 0) {
    $button = "<img src='images/check.svg' alt='My Happy SVG' class='pb-4' />";
}

$quantity = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addedBook = $row;
    $quantity = $_POST['quantity'];

    $addToCartQuery = "INSERT INTO cart VALUES ('" . $username . "', '" . $row['title'] . "', '" . $row['author'] . "', " . $row['price'] . ", '" . $row['ISBN'] . "', " . $quantity . ", '" . $row['imgPath'] . "', " . $row['stock'] . ")";
    $conn->query($addToCartQuery);
    $button = "<img src='images/check.svg' alt='My Happy SVG' class='pb-4' />";
}

?>

<!DOCTYPE>

<head>
    <link href="viewBook.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>

        <a href="customer-browseCatalog.php" class="GoBack pb-4"><b>
                << Go Back</b></a>

        <div class="container">

            <div class="row">
                <div class="col-lg-4 pt-4 pb-4 text-center" id="top">
                    <img class="pic" src="<?php echo $row['imgPath'] ?>" alt="Place Holder Book" style="width:210px;height:350px;">
                </div>
                <div class="col-lg-5 pt-4 pb-4 text-left mr-5" id="middle" style="margin-left: -2rem;">
                    <h1 class="TitleInfo"><?php echo $row['title'] ?></h1>
                    <a href="customer-browseCatalog.php?authorSearch=<?php echo $row['author'] ?>">
                        <h3 class="AuthorInfo pt-2"><?php echo $row['author'] ?></h3>
                    </a>
                    <div class="row pt-2 pr-2">
                        <div class="col text-left">
                            <!-- <p><?php echo $row['description'] ?></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 p-3 pt-5 pb-4 text-center" id="bottom">
                    <div class="row justify-content-center pt-5 pb-2" style="margin-bottom: -2rem;">
                        <h1 class="PriceInfo" style="font-size: 2rem;"><?php echo "$" . number_format($row['price'], 2) ?></h1>
                    </div>
                    <form method="post">
                        <button class="AddCart" name="addedBook"><?php echo $button ?></button>
                        <p class="InventoryText mt-2 mr-1"><b>Quantity:</b></p>
                        <select class="form-select" style="border-radius: 0.3rem; border-color: white;" name="quantity">
                            <?php for ($i = 1; $i <= $row['stock']; $i++) {
                                if ($i == $quantity) { ?>
                                    <option style="font-weight: bolder;" value="<?php echo $i ?>" selected> <?php echo $i ?>
                                    </option>
                                <?php } else { ?>
                                    <option style="font-weight: bolder;" value="<?php echo $i ?>"> <?php echo $i ?>
                                    </option>
                            <?php }
                            } ?>
                        </select><br><br>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'elements/footer.html' ?>

    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>