<?php
session_start();

require 'components/db_connect.php';
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

$backBtn = '';
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["adm"])) {
    $backBtn = "dashBoard.php";
}

//fetch and populate form
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $breed = $data['breed'];
        $size = $data["size"];
        $location = $data["location"];
        $description = $data["description"];
        $hobby = $data["hobby"];
        $age = $data["age"];
        $status = $data["status"];
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
    <title>CR11-LauraMoldovan - Adopt</title>
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
                Welcome, <?php echo $row1['fname'] . " " . $row1['lname'] ?>!
            </h3>
            <h1 class="text-center">
                <?php echo $name . " - " . $breed; ?>
            </h1>
        </div>
    </header>
    <main class="p-5">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="pictures/animals/<?php echo $picture; ?>" class="img-fluid rounded-start" alt="<?php echo $name; ?>">
                </div>
                <div class="col-md-8">
                    <div class='card-header text-center'>
                        <form action="adopted.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <p class="h2">Do you really want to adopt this pet?</p>
                                <input type="hidden" name="fk_user" value="<?php echo $row1['id'] ?>" />
                                <input type="hidden" name="fk_pet" value="<?php echo $id ?>" />
                                <td><button class='btn btn-success' type="submit">YES</button></td>
                                <td><a href="index.php"><button class='btn btn-danger' type="button">NO</button></a></td>
                            </tr>
                        </form>
                    </div>
                    <div class='card-body p-2'>
                        <p class='card-text'><b> Age: </b> <?php echo $age; ?></p>
                        <p class='card-text'><b> Size: </b> <?php echo $size; ?></p>
                        <p class='card-text'><b> Location: </b> <?php echo $location; ?></p>
                        <p class='card-text'><b> Hobbyes: </b> <?php echo $hobby; ?></p>
                        <p class='card-text'><?=$description?></p>
                    </div>
                    <h4 class='card-footer text-center'>
                        <?php echo $breed . " called ".$name; ?>
                    </h4>
                </div>
            </div>
        </div>

    </main>
    <footer class=" p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>