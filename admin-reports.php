<?php

session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 3) {
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

$total = 0;

$query = "SELECT vendor, title, ISBN, sold, cost, stock FROM report";
$values = $conn->query($query);

$showLow = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['vendor'])) {
        $showLow = 0;
        $vendor = $_POST['vendor'];
        $query = "SELECT vendor, title, ISBN, sold, cost, stock, revenue FROM report WHERE vendor='$vendor';";
        $values = $conn->query($query);
    } else if (!empty($_POST['lowInv'])) {
        $showLow = 1;
        $query = "SELECT vendor, title, ISBN, sold, cost, stock, revenue FROM report WHERE stock < 6;";
        $values = $conn->query($query);
    } else if (!empty($_POST['all'])) {
        $showLow = 0;
        $query = "SELECT vendor, title, ISBN, sold, cost, stock, revenue FROM report";
        $values = $conn->query($query);
    }
}

$totalCopiesSold = "SELECT SUM(sold) FROM report;";
$valuesTotal = $conn->query($totalCopiesSold);
$copiesSold = mysqli_fetch_array($valuesTotal);

$revenueQuery = "SELECT SUM(sold*cost) FROM report;";
$revenueResults = $conn->query($revenueQuery);
$revenueValue = mysqli_fetch_array($revenueResults);
$revenue = $revenueValue['SUM(sold*cost)'];

$promoQuery = "SELECT DISTINCT revenue, order_id FROM report;";
$promoResults = $conn->query($promoQuery);
$lossInPromos = 0;
while ($row = mysqli_fetch_array($promoResults)) {
    $lossInPromos = $lossInPromos + $row['revenue'];
}

$allBooksQuery = "SELECT * FROM book;";
$allBooksResults = $conn->query($allBooksQuery);
while ($row = mysqli_fetch_array($allBooksResults)) {
    $checkExistQuery = "SELECT * FROM report WHERE ISBN='$row[ISBN]';";
    $checkExistResults = $conn->query($checkExistQuery);
    if (mysqli_num_rows($checkExistResults) == 0) {
        $insertQuery = "INSERT INTO report (vendor, title, ISBN, sold, cost, stock, revenue) VALUES ('$row[username]', '$row[title]', '$row[ISBN]', '0', '$row[price]', '$row[stock]', '0');";
        $conn->query($insertQuery);
    }
}

?>

<!DOCTYPE>

<head>
    <link href="admin-reports.css" rel="stylesheet">
    <title>LittyLit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>
        <div class="col-10">
            <div class="top">
                <div class="row justify-content-center pt-5">
                    <h2 style="font-family: Nunito; color: #3F3D56"><strong>End of Day Sales Report</strong></h2>
                    <h2 class="totalSales">Total Sales: <span class="span1">$<?php echo ($revenue - $lossInPromos) ?></span></h2>
                    <h2 class="totalBooks">Total Books Sold: <span class="span2"><?php echo $copiesSold['SUM(sold)'] ?></span></h2> <br>
                </div>
                <div class="row justify-content-center pt-3">
                    <?php if ($showLow == 0) { ?>
                        <form method="post">
                            <button style="font-family: Nunito; background-color: #2B6777; border: 0px" type="submit" value="placeholder" name="lowInv" class="VLI btn btn-primary pr-6">View Low Inventory</button>
                        </form>
                    <?php } else { ?>
                        <form method="post">
                            <button style="font-family: Nunito; background-color: #2B6777; border: 0px" type="submit" value="placeholder" name="all" class="VLI btn btn-primary pr-6">View All Inventory</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <div class="bottom pl-5 pt-5">
                <div class="row">
                    <div class="col-3">
                        <h3><b>Title</b></h3>
                    </div>
                    <div class="col-2">
                        <h3><b>Vendor</b></h3>
                    </div>
                    <div class="col-2">
                        <h3><b>ISBN</b></h3>
                    </div>
                    <div class="col-1">
                        <h3><b>Sold</b></h3>
                    </div>
                    <div class="col-2">
                        <h3><b>Stock</b></h3>
                    </div>
                    <div class="col-2">
                        <h3><b>Revenue</b></h3>
                    </div>
                </div>
                <?php while ($row = mysqli_fetch_array($values)) {
                    $total = $total + ($row['sold'] * $row['cost']); ?>
                    <div class="row">
                        <div class="col-3 pt-4">
                            <h4><?php echo $row['title'] ?></h4>
                        </div>
                        <div class="col-2 pt-4">
                            <form method="post" class="inline">
                                <input type="hidden" value="<?php echo $row['vendor'] ?>" name="vendor">
                                <button type="submit" class="link-button" style="padding: 0.1rem 1rem;">
                                    <?php echo $row['vendor'] ?>
                                </button>
                            </form>
                        </div>
                        <div class="col-2 pt-4">
                            <h4><?php echo $row['ISBN'] ?></h4>
                        </div>
                        <div class="col-1 pt-4">
                            <div class="row pl-3">
                                <h4><?php echo $row['sold'] ?></h4>
                            </div>
                        </div>
                        <div class="col-2 pt-4">
                            <?php if ($row['stock'] < 10) { ?>
                                <h4 style="color: red;"><?php echo $row['stock'] ?></h4>
                            <?php } else { ?>
                                <h4><?php echo $row['stock'] ?></h4>
                            <?php } ?>
                        </div>
                        <div class="col-2 pt-4">
                            <h4>$<?php echo number_format($row['sold'] * $row['cost'], 2) ?></h4>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>
        <div style="margin-top: 10rem;">
            <?php include 'elements/footer.html' ?>
        </div>
    </main>
</body>

</html>