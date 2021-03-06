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

$userType = $_SESSION['userType'];

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}

$authorSearch = "";
isset($_POST['authorSearch']) ? $authorSearch = $_POST['authorSearch'] : ($authorSearch = $_GET['authorSearch'] ?? "");

$getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book;";

$searchPlaceHolder = "Search!";

if ($authorSearch != "") {
    $getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book WHERE author LIKE '%" . $authorSearch . "%';";
    $searchPlaceHolder = $authorSearch;
}

$values = $conn->query($getBooksQuery);

$option = "title";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchPlaceHolder = "";
    $search = $_POST['search'];
    $filter = $_POST['radio'] ?? "";
    if ($search == "") {
        $getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book;";
        $values = $conn->query($getBooksQuery);
    } else {
        if ($filter == "title") {
            $option = "title";
            $getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book WHERE title LIKE '%" . $search . "%';";
        } else if ($filter == "author") {
            $option = "author";
            $getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book WHERE author LIKE '%" . $search . "%';";
        } else if ($filter == "ISBN") {
            $option = "ISBN";
            $getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book WHERE ISBN='" . $search . "';";
        } else if ($filter == "genre") {
            $option = "genre";
            $getBooksQuery = "SELECT username, title, author, price, ISBN, imgPath FROM book WHERE genre LIKE '%" . $search . "%';";
        }
        $values = $conn->query($getBooksQuery);
    }
}
# 
# $price = isset($books['price']) ? htmlspecialchars($books['price']) : '';
# $author = isset($books['author']) ? htmlspecialchars($books['author']) : '';
# $title = isset($books['title']) ? htmlspecialchars($books['title']) : '';
#                <?php while ($row = mysqli_fetch_array($values)) {?/>
#                <?php }?/>
?>

<!DOCTYPE>

<head>
    <link href="customer-browseCatalog.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>
        <div class="container-fluid mt-5">
            <div class="mx-auto text-center" style="width: 400px;">
                <form method="post">

                    <div class="form-group rounded">
                        <div class="row">
                            <div class="col-11">
                                <input type="search" name="search" id="inputEmail" class="form-control rounded" placeholder="<?php echo $searchPlaceHolder ?>" aria-label="Search" aria-describedby="search-addon" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" />
                            </div>
                            <div class=" col-1" style="align-items: center; display: flex; margin-left: -1rem;">
                                <button class="input-group-text border-2" style=" border-width: 0rem; background-color: #C8D8E4; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <i class="fa fa-search" id="icon" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="title" style="box-shadow: none !important;" <?php if ($option == "title") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                        <label class=" form-check-label" for="inlineRadio1">Title</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="genre" style="box-shadow: none !important;" <?php if ($option == "genre") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                        <label class="form-check-label" for="inlineRadio2">Genre</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="author" style="box-shadow: none !important;" <?php if ($option == "author") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                        <label class="form-check-label" for="inlineRadio3">Author</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="ISBN" style="box-shadow: none !important;" <?php if ($option == "ISBN") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                        <label class="form-check-label" for="inlineRadio3">ISBN</label>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-12 pt-4">
            <div class="row justify-content-center">
                <?php
                if (mysqli_num_rows($values) == 0) {
                    echo "<div style='padding-top: 5rem;'><h3>No results found for \"" . $search . "\".</h3></div>";
                }
                ?>
                <?php while ($row = mysqli_fetch_array($values)) { ?>
                    <a href="viewBook.php?selectedBook=<?php echo $row['ISBN'] ?>">
                        <div class="card ml-4 mr-4 mt-4 mb-4">
                            <div class="col-sm-12 justify-content-center">
                                <div class="row">
                                    <div class="card-body ml-1">
                                        <img class="card-img-top mx-auto mt-3 mb-4" src="<?php echo $row['imgPath'] ?>" alt="Place Holder Book" style="height: 10rem; width: 8rem; display:block">
                                        <div class="row justify-content-center">
                                            <h4 class="card-title text-center" style="font-size: 1.2rem;"><?php echo $row['title'] ?></h4>
                                        </div>
                                        <div class="row justify-content-center" style="margin-top: -0.5rem; font-size: 0.9rem;">
                                            <p class="card-text"><?php echo $row['author'] ?></p>
                                        </div>
                                        <div class="row pt-4 justify-content-center">
                                            <p class="card-text" style="font-size: 1.3rem;"><?php echo "$" . number_format($row['price'], 2) ?></p>
                                        </div>
                                        <div class="row pt-1 justify-content-center">
                                            <p class="card-text" style="font-size: 0rem;"><?php echo $row['ISBN'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php include 'elements/footer.html'; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>