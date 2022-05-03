<?php
if ($_SESSION['userType'] != 2) {
    header("Location: home.php");
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
            <div class="row">
                <div class=col-lg-3>
                    <img class="pic" src="images/Gatsby.png" alt="Place Holder Book" style="width:210px;height:350px;">
                    <a href="#" class="Cover"><b>Change Cover</b></a>
                </div>


                <div class=col-lg-3 id="QMiddle">
                    <form action="">
                        <p><b>Book Title</b></p><br>
                        <input class="Text" type="text" id="btitle" name="btitle" placeholder="The Great Gatsby"><br><br>

                        <p><b>Author</b></p><br>
                        <input class="Text" type="text" id="btitle" name="btitle" placeholder="F. Scott Fitzgerald"><br><br>

                        <p><b>Genre</b>
                        <p><br>
                            <select class="TextDrop">
                                <option style="font-weight: bolder;" value="Fiction" selected> Fiction
                                </option>
                            </select>
                    </form>

                </div>
                <div class=col-lg-3 id="QEnd">
                    <form action="">
                        <p><b>Inventory:</b></p>
                        <select class="Inventory">
                            <option style="font-weight: bolder;" value="Number" selected> 100
                            </option>
                        </select><br><br>

                        <p><b>Price</b></p><br>
                        <p>$</p><input class="TextPrice" type="text" id="btitle" name="btitle" placeholder="5.00"><br><br>

                        <p><b>ISBN</b></p><br>
                        <input class="TextISBN" type="text" id="btitle" name="btitle" placeholder="ABC123"><br><br>
                    </form>

                </div>
                <div class=col-lg-3 id="Button">

                    <button onclick="window.location.href='#'" class="SaveChanges">Save Changes</button><br>
                    <a href="#" class="Remove"><b>Remove Book</b></a>

                </div>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>