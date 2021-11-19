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
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>CR11-LauraMoldovan - Edit Pet</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" type='text/css' href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Great+Vibes&display=swap" rel="stylesheet">
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
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
                Update <?php echo $name . " - " .$breed ?>
            </h1>
        </div>
    </header>
    <main>
    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/animals/<?php echo $data['picture'] ?>' alt="<?php echo $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="name" value="<?php echo $name ?>" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" value="<?php echo $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="text" name="size" value="<?php echo $size ?>" /></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class='form-control' type="text" name="location" value="<?php echo $location ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" value="<?php echo $description ?>" /></td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class='form-control' type="text" name="hobby" value="<?php echo $hobby ?>" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" value="<?php echo $age ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <th>Available in Petshop</th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="<?php echo $status ?>" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                <?php
                                if ($status = 1)
                                    echo "YES";
                                else
                                    echo "NO"; ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="<?php echo !$status ?>">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <?php
                                if ($status = 1)
                                    echo "NO";
                                else
                                    echo "YES"; ?>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
    </main>
    <footer class="p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>