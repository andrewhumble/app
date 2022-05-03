<?php
session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$userType = $_SESSION['userType'];

if (!isset($_SESSION['username']) || $_SESSION['userType'] != 2) {

    header("Location: welcome.html");
    exit();
} else {
    $isbn = $_SESSION['is'];
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}

isset($_POST['selectedBook']) ? $selectedBook = $_POST['selectedBook'] : $selectedBook = $_GET['selectedBook'];


$getBooksQuery = "SELECT username, title, author, price, genre, ISBN, stock, imgPath FROM book WHERE ISBN='$selectedBook';";

$values = $conn->query($getBooksQuery);
$row = mysqli_fetch_array($values);

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["save"])) {
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
    $inventory = isset($_POST['inventory']) ? htmlspecialchars($_POST['inventory']) : '';
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        header("Location: vendor-myBooks.php");



        if ($target_file != 'images/') {
            echo "Here 2";

            $sql = "UPDATE book SET imgPath='$target_file' WHERE ISBN ='$selectedBook'";
            $conn->query($sql);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File has been successfully uploaded";
            }
        }

    $sql = "UPDATE book SET title='$title', author='$author', price=$price, genre='$genre', stock=$inventory, imgPath='$row[imgPath]' WHERE ISBN ='$selectedBook'";
    $conn->query($sql);
    
    }

    if (isset($_POST["submitbutton"])) {
        $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
        $author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
        $genre = $_POST['genre'] ? htmlspecialchars($_POST['genre']) : '';
        $price = $_POST['price'] ? htmlspecialchars($_POST['price']) : '';
        $inventory = isset($_POST['inventory']) ? htmlspecialchars($_POST['inventory']) : '';
        $sql = "DELETE FROM book WHERE ISBN ='$selectedBook'";
        $conn->query($sql);
        header("Location: vendor-myBooks.php");
}


?>


<!DOCTYPE>

<head>
    <link href="vendor-editBook.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php'; ?>

        <a href="vendor-myBooks.php" class="GoBack"><b>
                << Go Back</b></a>

        <div class="container mt-5">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-3">
                        <img class="pic" src="<?php echo $row['imgPath'] ?>" alt="Place Holder Book"
                            style="width:210px;height:350px;">
                        <input class="pb-4 pt-4 pl-4" type="file" name="image"
                            style="font-family: Nunito !important; color: #3F3D56 !important;">
                    </div>
                    <div class="col-sm-9 pt-5">
                        <div class="row pb-3">
                            <div class="col-5">
                                <p><b>Book Title</b></p>
                                <input class="form-control rounded" type="text" id="btitle" name="title"
                                    value="<?php echo $row['title'] ?>">
                            </div>
                            <div class="col-3">
                                <p><b>Inventory:</b></p>
                                <input class="form-control rounded" type="text" id="btitle" name="inventory"
                                    value="<?php echo $row['stock'] ?>">
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-5">
                                <p><b>Author</b></p>
                                <input class="form-control rounded" type="text" id="btitle" name="author"
                                    value="<?php echo $row['author'] ?>">
                            </div>
                            <div class="col-3">
                                <p><b>Price</b></p>
                                <p>$</p><input class="form-control rounded" type="text" id="btitle" name="price"
                                    value="<?php echo $row['price'] ?>">
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-5">
                                <p><b>Genre</b></p>
                                <input type="text" class="form-control rounded" name="genre"
                                    value="<?php echo $row['genre'] ?>">
                            </div>
                            <div class="col-3">
                                <p><b>ISBN</b></p>
                                <input class="form-control rounded" type="text" id="btitle" name="ISBN"
                                    value="<?php echo $row['ISBN'] ?>">
                            </div>
                        </div>

                        <div class="row float-right align-items-end pr-4 pt-4">
                            <div class="col-6">
                                <button
                                    style="background-color: transparent; color: black; text-decoration: underline; border: 0px;"
                                    name="submitbutton" type="submit" class="btn btn-primary pr-6">Delete Book</button>
                            </div>
                            <div class="col-6 justify-content-center">
                                <button style="background-color: #2B6777; border: 0px;" name="submitButton"
                                    type="submit" class="btn btn-primary pr-6 mt-5">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php include 'elements/footer.html'; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>