<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}




require_once '../components/db_connect.php';
$id1 = $_SESSION['adm'];
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $id1);
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data['name'];
        $breed = $data['breed'];
        $picture = $data["picture"];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR11-LauraMoldovan - Delete Pet</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" type='text/css' href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Great+Vibes&display=swap" rel="stylesheet">
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
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
                                <a class="nav-link" href="../home.php">
                                    Website
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Edit Pet List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../update.php?id=<?php echo $row1['id'] ?>">
                                    Update Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../logout.php?logout">Sign Out</a>
                            </li>
                            <li class='nav-item'>
                                 <a class='nav-link' href='../dashBoard.php'>Admin Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </ul>
        <div class="hero p-5">
            <h3>
                Welcome, <?php echo $row1['fname'] . " " . $row1['lname'] . "!"; ?>
            </h3>
            <h1 class="text-center">
                Delete <?php echo $name . " - " .$breed ?>
            </h1>
        </div>
    </header>
    <main class="pb-5">
    <fieldset>
        <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../pictures/animals/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <h5>You have selected the data below:</h5>
        <table class="table w-75 mt-3">
            <tr>
                <td><?php echo $name ?> - <?php echo $breed ?></td>
            </tr>
        </table>

        <h3 class="mb-4">Do you really want to delete this Pet?</h3>
        <form action="actions/a_delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it!</button>
            <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
        </form>
    </fieldset>
    </main>
    <footer class="p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>