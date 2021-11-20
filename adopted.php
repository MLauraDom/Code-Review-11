<?php
session_start();


require_once 'components/db_connect.php';
if (!isset($_SESSION['adm']) && isset($_SESSION['user'])) {

    $res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
} else if (isset($_SESSION['adm']) && !isset($_SESSION['user'])) {

    $res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['adm']);
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

mysqli_close($connect);

$backBtn = '';
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["adm"])) {
    $backBtn = "dashBoard.php";
};
require 'components/db_connect.php';
if ($_POST) {
    $fk_user = $_POST['fk_user'];
    $fk_pet = $_POST['fk_pet'];
    $a_date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO adoption (a_date, fk_user, fk_pet) VALUES ('$a_date', $fk_user, $fk_pet)";
    $result = mysqli_query($connect, $sql);
    $sql3 = "UPDATE animals SET status = 0 WHERE id = {$fk_pet}";
    $res3 = mysqli_query($connect, $sql3);

    if ($result === true and $res3 === true) {
        $class = "success";
        $message = "Congratulations," . $row1['fname'] . " " . $row1['lname'] . "!<br>
            Youre adoption was successfull ! ";
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
};

require 'components/db_connect.php';
$sql2 = "SELECT * FROM adoption
        JOIN user ON adoption.fk_user = user.id
        JOIN animals ON adoption.fk_pet = animals.id
        WHERE animals.id = {$fk_pet}";
    
    $res2 = mysqli_query($connect, $sql2);
    $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR11-LauraMoldovan - Adopted</title>
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
                                <a class="nav-link" href="#">Logged in as </br><?php echo $row1['fname'] . " " . $row1['lname']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </ul>
        <div class="hero p-5">
            <h3>
                Thank you, <?php echo $row2['fname'] . " " . $row2['lname'] ?>, for adopting
            </h3>
            <h1 class="text-center">
            <?php echo $row2['name'] . " - " . $row2['breed'] ?>
            </h1>
        </div>
    </header>
    <main class="p-5">
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='adopt.php?id=<?= $fk_pet ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='<?= $backBtn ?>'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-8">
                    <h4 class='card-header text-center'><?php echo $row2['name'] ?></h4>
                    <div class='card-body p-2'>
                        <p class='card-text'><b> Breed: </b> <?php echo $row2['breed'] ?></p>
                        <p class='card-text'><b> Age: </b> <?php echo $row2['age'] ?></p>
                        <p class='card-text'><b> Size: </b> <?php echo $row2['size']  ?></p>
                        <p class='card-text'><b> Location: </b> <?php echo $row2['location']  ?></p>
                        <p class='card-text'><b> Hobbyes: </b> <?php echo $row2['hobby']  ?></p>
                        <p class='card-text'><?php echo $row2['description']  ?></p>
                    </div>
                    <div class='card-footer text-center'>
                        <p class='btn btn-small bg-danger'>Adopted by <?php echo $row2['fname'] . " " . $row2['lname'] ?></p>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer class=" p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>