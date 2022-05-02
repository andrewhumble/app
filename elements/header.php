<?php
if (!isset($_SESSION['userType'])) {
    echo "<!DOCTYPE html>

<head>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>
    <link href='elements/header.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<nav class='navbar navbar-expand-lg navbar-light bg-light'>
    <a class='navbar-brand pl-4' href='home.php' style='font-size: 60px; color: #3F3D56; font-family: Girassol;'>LL</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup'
        aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
        <div class='navbar-nav d-lg-flex align-items-center mt-3'>

        </div>
    </div>
</nav>

</html>";
} else if ($_SESSION['userType'] == 1) {
    echo "<!DOCTYPE html>

<head>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>
    <link href='elements/header.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<nav class='navbar navbar-expand-lg navbar-light bg-light'>
    <a class='navbar-brand pl-4' href='home.php'>LittyLit</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
        <div class='navbar-nav d-lg-flex align-items-center mt-3'>
            <a class='nav-item h-100 nav-link' href='customer-browseCatalog.php'>
                <h5>Browse</h5>
            </a>
            <a class='nav-item h-100 nav-link' href='customer-myAccount.php'>
                <h5>My Account</h5>
            </a>
            <a class='nav-item h-100 mb-3 nav-link' href='cart.php'><img src='./images/cart.png' height='60px' width='60px'></a>
        </div>
    </div>
</nav>

</html>";
} else if ($_SESSION['userType'] == 2) {
    echo "<!DOCTYPE html>

<head>
    <link href='elements/header.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<nav class='navbar navbar-expand-lg navbar-light bg-light'>
    <a class='navbar-brand pl-4' href='home.php' style='font-size: 60px; color: #3F3D56'>LittyLit</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup'
        aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
        <div class='navbar-nav d-lg-flex align-items-center mt-3'>
            <a class='nav-item h-100 nav-link' href='vendor-myBooks.php'>
                <h5>My Books</h5>
            </a>
            <a class='nav-item h-100 nav-link' href='vendor-myAccount.php'>
                <h5>My Account</h5>
            </a>
        </div>
    </div>
</nav>

</html>";
} else if ($_SESSION['userType'] == 3) {
    echo "<!DOCTYPE html>

<head>
    <link href='elements/header.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<nav class='navbar navbar-expand-lg navbar-light bg-light'>
    <a class='navbar-brand pl-4' href='home.php' style='font-size: 60px; color: #3F3D56'>LittyLit</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup'
        aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
        <div class='navbar-nav d-lg-flex align-items-center mt-3'>
            <a class='nav-item h-100 nav-link' href='#'>
                <h5>Search Orders</h5>
            </a>
            <a class='nav-item h-100 nav-link' href='#'>
                <h5>Search Users</h5>
            </a>
            <a class='nav-item h-100 nav-link' href='#'>
                <h5>Search Books</h5>
            </a>
            <a class='nav-item h-100 nav-link' href='admin-myAccount.php'>
                <h5>My Account</h5>
            </a>
            <a class='nav-item h-100 nav-link' href='#'>
                <h5>Reports</h5>
            </a>
        </div>
    </div>
</nav>

</html>";
}
