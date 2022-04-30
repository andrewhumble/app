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

isset($_POST['selectedBook']) ? $selectedBook = $_POST['selectedBook'] : $selectedBook = $_GET['selectedBook'];

$getBooksQuery = "SELECT title, author, price, genre, isbn, stock, imgPath FROM book WHERE isbn=$selectedBook;";
$values = $conn->query($getBooksQuery);
$row = mysqli_fetch_array($values);

?>

<!DOCTYPE>

<head>
    <link href="viewBook.css" rel="stylesheet">
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

        <div class="container">

            <div class="row">
                <div class="col-lg-4 p-1 pt-4 pb-4 text-center" id="top">
                    <img class="pic" src="<?php echo $row['imgPath'] ?>" alt="Place Holder Book" style="width:210px;height:350px;">
                </div>
                <div class="col-lg-5 p-3 pt-4 pb-4 text-left" id="middle">
                    <h1 class="TitleInfo"><?php echo $row['title'] ?></h1>
                    <h3 class="AuthorInfo"><?php echo $row['author'] ?></h3>
                    <h1 class="PriceInfo"><?php echo "$" . number_format($row['price'], 2) ?></h1>
                </div>
                <div class="col-lg-2 p-3 pt-4 pb-4 text-center" id="bottom">
                    <button onclick="window.location.href='#'" class="AddCart">Add to Cart</button><br>
                    <p class="InventoryText"><b>Quantity:</b></p>
                    <select class="Inventory">
                        <option style="font-weight: bolder;" value="Number" selected> <?php echo $row['stock'] ?>
                        </option>
                    </select><br><br>
                </div>
            </div>
        </div>


    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>