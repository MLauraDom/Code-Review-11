<?php
session_start();
require 'components/db_connect.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['adm']) && isset($_SESSION['user'])) {

    $res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
} else if (isset($_SESSION['adm']) && !isset($_SESSION['user'])) {

    $res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['adm']);
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

$sql = $_GET['id'];
$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "
        <div class='col p-3'>
            <div class='card p-0 shadow-lg bg-body rounded all-animals'>
                <img class='card-img-top' src='pictures/animals/" . $row['picture'] . "'alt='" . $row['name'] . "'>
                <h4 class='card-header text-center'>" . $row['name'] . "</h4>
                <div class='card-body p-2'>
                    <p class='h5 card-text text-center'>" . $row['breed'] . "</p>
                    <p class='card-text'>Written by " . $row['description'] . "</p>
                    <p class='h6'>
                    Age: " . $row['age'] . " years old.
                    </p>
                </div>
                <div class='card-footer text-center'>
                   <a class='btn btn-small bg-info' href='details.php?id=" . $row['id'] . "'>Show Details</a>
                </div>
            </div>
        </div>";
    }
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
};

$filter1 = "SELECT * FROM animals WHERE age<=2";
$filter2 = "SELECT * FROM animals WHERE age>2 AND age<8";
$filter3 = "SELECT * FROM animals WHERE age>=8";


mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR11-LauraMoldovan - Petshop</title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" type='text/css' href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <ul class="nav menu">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php">
                                    HOME
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="update.php?id=<?php echo $row1['id'] ?>">
                                    Update Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php?logout">Sign Out</a>
                            </li>
                            <?php if (isset($_SESSION['adm']))
                                echo "<li class='nav-item'>
                                 <a class='nav-link' href='dashBoard.php'>Admin Dashboard</a></li>"
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Logged in as </br><?php
                                                                                echo $row1['fname'] . " " . $row1['lname'];
                                                                                ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </ul>
        <div class="hero p-5">
            <h3>
                Welcome to our Page!
            </h3>
            <h1 class="text-center">
                Adopt a Pet!
            </h1>
        </div>
    </header>
    <main class="p-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">All</a>
                        <a class="nav-link" href="filter.php?id=<?php echo $filter1 ?>">Junior Pets</a>
                        <a class="nav-link" href="filter.php?id=<?php echo $filter2 ?>">Middleage Pets</a>
                        <a class="nav-link" href="filter.php?id=<?php echo $filter3 ?>">Senior Pets</a>
                    </div>
                </div>
            </div>
        </nav>
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 cont">
            <?= $tbody; ?>
        </div>
    </main>
    <footer class="p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>