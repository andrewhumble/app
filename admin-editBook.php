<?php
session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$userType = $_SESSION['userType'];
if (!isset($_SESSION['username']) || $_SESSION['userType'] != 3) {

    header("Location: welcome.html");
    exit();
} else {
    $isbn = $_SESSION['is'];
    $userType = $_SESSION['userType'];
}



$getBooksQuery = "SELECT username, title, author, genre, price, isbn, inventory, image FROM book WHERE isbn='" . $_SESSION['is'] . "';";
$values = $conn->query($getBooksQuery);
$row = mysqli_fetch_array($values);
$title = isset($row['title']) ? htmlspecialchars($row['title']) : '';
$author = isset($row['author']) ? htmlspecialchars($row['author']) : '';
$genre = isset($row['genre']) ? htmlspecialchars($row['genre']) : '';
$price = isset($row['price']) ? htmlspecialchars($row['price']) : '';
$inventory = isset($row['inventory']) ? htmlspecialchars($row['inventory']) : '';
$image = isset($row['image']) ? htmlspecialchars($row['image']) : '';

echo $getBooksQuery;
echo $row['title'];

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submitButton"])) {
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
    $inventory = isset($_POST['inventory']) ? htmlspecialchars($_POST['inventory']) : '';
    if (!empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $sqls = "UPDATE book SET image='$imgContent' WHERE isbn = ='" . $_SESSION['is'] . "';";
            $conn->query($sqls);
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
    $sql = "UPDATE book SET title='$title', author='$author', genre='$genre', price='$price', inventory='$inventory' WHERE isbn ='" . $_SESSION['is'] . "';";
    echo $sql;
    $conn->query($sql);

    header("Location: admin-editBook.php?selectedBook=$selectedBook");
}


?>


<!DOCTYPE>

<head>
    <link href="admin-editBook.css" rel="stylesheet">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <ul>
            <li><a class="active" href="home.html">LittyLit</a></li>
            <li><a class="searchOrdersNav" href="">Search Orders</a></li>
            <li><a class="searchUsersNav" href="">Search Users</a></li>
            <li><a class="searchBooksNav" href="">Search Books</a></li>
            <li><a class="myAccNav" href="admin-myAccount.html">My Account</a></li>
            <li><a class="reportsNav" href="">Reports</a></li>
          </ul>
          
          <!-- <a href="#" class = "GoBack"><b> << Go Back</b></a> -->
        
          <div class="center">
            <form method="post">
                    <div class="picLeft" style="width: 280px;height:510px;">
                    
                        <img class="pic" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="Place Holder Book" style="width:210px;height:350px;">
                        <input type="file" name="image">
                        <!-- <input type="file" name="image" value="Change Cover"> -->
                        <!-- <a href="#" class="Cover"><b>Change Cover</b></a> -->
                    </div>

                <div class="QMiddle" style="width: 350px;">
                        <p><b>Book Title</b></p><br>
                        <input class="Text" type="text"  name="title" value="<?php echo $row['title'] ?>"><br><br>

                        <p><b>Author</b></p><br>
                        <input class="Text" type="text"  name="author" value="<?php echo $row['author'] ?>"><br><br>

                        <p><b>Genre</b>
                        <p><br>
                        <input class="Text" class="TextDrop" name="genre" value="<?php echo $row['genre'] ?>"><br><br>

                </div>

                <div class="QEnd" style="width: 300px;">
                        <p><b>Inventory:</b></p>
                        <input class="Inventory" type="text" id="btitle" name="inventory" value="<?php echo $row['inventory'] ?>"><br><br> 

                        <!-- <select class="Inventory">  
                                <option style="font-weight: bolder;" value = "Number" selected> 100   
                                </option>  
                            </select>-->
                        <!-- <br><br>  -->

                        <p><b>Price</b></p><br>
                        <p>$</p><input class="TextPrice" type="text" id="btitle" name="price" value="<?php echo $row['price'] ?>"><br><br>

                        <p><b>ISBN</b></p><br>
                        <input class="TextISBN" type="text" id="btitle" name="isbn" value="<?php echo $row['isbn'] ?>"><br><br> 

                </div>

                <div class="Buttons" style="width: 300px;">
                    <a href="#" class="Remove"><b>Remove Book</b></a>
                        
                    <button name="submitButton" type="submit" value="test" class="btn btn-primary pr-6">Save Changes</button>
                        

                </div>

            </form>
             
            
              

              

            
    </main>
</body>

</html>



