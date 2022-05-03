<?php
session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$userType = $_SESSION['userType'];
//ensures someone is logged inbefore allowing them to create a profile
if (!isset($_SESSION['username']) || $_SESSION['userType'] != 2) {

    header("Location: welcome.html");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];

    // $titles = $_SESSION['title'];
    // echo $titles;
}

isset($_POST['selectedBook']) ? $selectedBook = $_POST['selectedBook'] : $selectedBook = $_GET['selectedBook'];

echo $selectedBook;

$getBooksQuery = "SELECT username, title, author, genre, price, ISBN, Inventory, image FROM book WHERE isbn='$selectedBook';";
$values = $conn->query($getBooksQuery);
$row = mysqli_fetch_array($values);

echo $row['title'];

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["save"])) {
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
    $inventory = isset($_POST['inventory']) ? htmlspecialchars($_POST['inventory']) : '';
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        // $folder = "images/".$filename;
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $sql = "UPDATE book SET image='$imgContent' WHERE isbn ='$selectedBook'";
            $conn->query($sql);
        }
    } else {
        echo "hi";
    }
    //$password = $_POST['password'];
    // $email = $_POST['email'] ? htmlspecialchars($_POST['email']) : '';
    // $birthday = $_POST['birthday'] ? htmlspecialchars($_POST['birthday']) : '';
    // $strAddress = isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : '';
    // $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    // $state = $_POST['state'] ? htmlspecialchars($_POST['state']) : '';
    // $zip = $_POST['zip'] ? htmlspecialchars($_POST['zip']) : '';
    $sql = "UPDATE book SET title='$title', author='$author', genre='$genre', price='$price', Inventory='$inventory' WHERE isbn ='$selectedBook'";
    echo $sql;
    $conn->query($sql);

    header("Location: vendor-editBook.php?selectedBook=$selectedBook");
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
        <!-- <ul>
            <li><a class="active" href="home.html">LittyLit</a></li>
            <a href="#" class = "MyBooks"><b>My Account</b></a>
            <a href="#" class = "MyBooks"><b>My Books</b></a>
          </ul> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pl-4" href="#" style="font-size: 60px; color: #3F3D56">LittyLit</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav d-lg-flex align-items-center mt-3">
                    <a class="nav-item h-100 nav-link" href="vendor-myBooks.php">
                        <h5>My Books</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="vendor-myAccount.php">
                        <h5>My Account</h5>
                    </a>
                </div>
            </div>
        </nav>

        <a href="vendor-myBooks.php" class="GoBack"><b>
                << Go Back</b></a>

        <div class="container">
            <form method="post"  enctype="multipart/form-data">
                <div class="row">
                    <div class=col-lg-3>
                        <img class="pic" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="Place Holder Book" style="width:210px;height:350px;">
                        <input type="file" name="image">
                        <!-- <input type="file" name="image" value="Change Cover"> -->
                        <!-- <a href="#" class="Cover"><b>Change Cover</b></a> -->
                    </div>


                    <div class=col-lg-3 id="QMiddle">
                        <p><b>Book Title</b></p><br>
                        <input class="Text" type="text" id="btitle" name="title" value="<?php echo $row['title'] ?>"><br><br>

                        <p><b>Author</b></p><br>
                        <input class="Text" type="text" id="btitle" name="author" value="<?php echo $row['author'] ?>"><br><br>

                        <p><b>Genre</b>
                        <p><br>
                            <input type="text" class="TextDrop" name="genre" value="<?php echo $row['genre'] ?>"><br><br>

                            <!-- <select class="TextDrop">  
                            <option style="font-weight: bolder;" value = "Fiction" selected> Fiction   
                            </option>  
                            </select> -->

                    </div>
                    <div class=col-lg-3 id="QEnd">
                        <p><b>Inventory:</b></p>
                        <input class="Inventory" type="text" id="btitle" name="inventory" value="<?php echo $row['Inventory'] ?>"><br><br>

                        <!-- <select class="Inventory">  
                                <option style="font-weight: bolder;" value = "Number" selected> 100   
                                </option>  
                            </select>-->
                        <!-- <br><br>  -->

                        <p><b>Price</b></p><br>
                        <p>$</p><input class="TextPrice" type="text" id="btitle" name="price" value="<?php echo $row['price'] ?>"><br><br>

                        <!-- <p><b>ISBN</b></p><br>
                        <input class="TextISBN" type="text" id="btitle" name="isbn" value="<?php echo $row['ISBN'] ?>"><br><br> -->

                    </div>
                    <div class=col-lg-3 id="Button">

                        <button type="submit" class="SaveChanges" name="save">Save Changes</button><br>
                        <a href="#" class="Remove"><b>Remove Book</b></a>

                    </div>

            </form>
        </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>