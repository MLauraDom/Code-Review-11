<?php
session_start();

require_once '../components/db_connect.php';


if (isset($_SESSION['user'])) {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$id1 = $_SESSION['adm'];
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $id1);
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>CR11-LauraMoldovan - Add Pet</title>
    <link rel="stylesheet" type='text/css' href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
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
                Add a new Pet
            </h1>
        </div>
    </header>
    <main>
    <fieldset>
        <legend class='h2'>Add Pet</legend>
        <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Pet Name" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Breed" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="text" name="size" placeholder="Size" /></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class='form-control' type="text" name="location" placeholder="Location" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" placeholder="Description" /></td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class='form-control' type="text" name="hobby" placeholder="Hobbies" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Age" /></td>
                </tr>

                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Pet</button></td>
                    <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
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