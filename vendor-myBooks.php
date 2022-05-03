<?php
session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 2) {
    header("Location: home.php");
}

$userType = $_SESSION['userType'];
//ensures someone is logged inbefore allowing them to create a profile
if (!isset($_SESSION['username']) || $_SESSION['userType'] != 2) {

    header("Location: welcome.html");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}

$getBooksQuery = "SELECT username, title, author, price, genre, ISBN, stock, imgPath FROM book WHERE username='$username';";
$values = $conn->query($getBooksQuery);

$length = mysqli_num_rows($values);
// echo $length;

$order = array_fill(0, $length, NULL);

$i = 0;
while ($row = mysqli_fetch_array($values)) {
    $order[$i] = $row;
    $i++;
}
?>

<!DOCTYPE>

<head>
    <link href="vendor-myBooks.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mt-5">My Books</h1>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <button onclick="window.location.href='vendor-addBook.php'" class="btn mt-5" style="padding: 0.5rem 7rem;">Add
                        Book</button>
                </div>
            </div>
        </div>

        <div class="col-sm-12 pt-4">
            <div class="row justify-content-center">

                <?php foreach ($order as $o) { ?>

                    <a href="vendor-editBook.php?selectedBook=<?php echo $o['ISBN'] ?>">
                        <div class="card ml-4 mr-4 mt-4 mb-4" style="background-color: #2B6777; height: 22rem; width: 15rem; border-radius: 1em !important;">
                            <div class="col-sm-12 justify-content-center">
                                <div class="row">
                                    <div class="card-body ml-1">
                                        <img class="card-img-top mx-auto mt-3 mb-4" src="<?php echo $o['imgPath'] ?>" alt="Place Holder Book" style="height: 10rem; width: 8rem; display:block">
                                        <div class="row justify-content-center">
                                            <h4 class="card-title text-center" style="font-size: 1.2rem;"><?php echo $o['title']; ?></h4>
                                        </div>
                                        <div class="row justify-content-center" style="margin-top: -0.5rem; font-size: 0.9rem;">
                                            <p class="card-text" style="color: #fff !important;"><?php echo $o['author']; ?></p>
                                        </div>
                                        <div class="row pt-4 justify-content-center">
                                            <p class="card-text" style="font-size: 1.3rem; color: #fff !important;"><?php echo "$" . number_format($o['price'], 2) ?></p>
                                        </div>
                                        <div class="row pt-1 justify-content-center">
                                            <p class="card-text" style="font-size: 0rem; color: #fff !important;"><?php echo $o['stock'] ?> in stock</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- <img class="pic" src="<?php echo $o['imgPath'] ?>" alt="Place Holder Book" style="width:150px; height:200px; margin-top: 20px" /><br>

                    <h4><?php echo $o['title']; ?></h4>


                     <?php $_SESSION['title'] = $o['title']; ?>


                    <p><?php echo $o['author']; ?></p>
                    <?php $_SESSION['author'] = $o['author']; ?>

                    <pre> Inventory: <?php echo $o['stock']; ?>               <?php echo $o['price']; ?></pre>
                    <a href="vendor-editBook.php?selectedBook=<?php echo $o['ISBN'] ?>" class="EditText">Edit</a>
                    <button onclick="window.location.href='vendor-editBook.php'" class="EditText">Edit</button><br> -->



                <?php } ?>
            </div>



    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>