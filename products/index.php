<?php
session_start();
require_once '../components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit;
}

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail' src='../pictures/animals/" . $row['picture'] . "'</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
            </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
};


$id = $_SESSION['adm'];
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $id);
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR11-LauraMoldovan - Pet Dashboard</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" type='text/css' href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Great+Vibes&display=swap" rel="stylesheet">
    <style type="text/css">
        .manageProduct {
            margin: auto;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: center;
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
                                <a class="nav-link active" aria-current="page" href="index.php">Edit Pet List
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
                Pet Dashbord
            </h1>
        </div>
    </header>
    <main class="p-5">
    <div class="manageProduct w-75 mt-3">
        <div class='mb-3'>
            <a href="create.php"><button class='btn btn-primary' type="button">Add pet</button></a>
        </div>
        <p class='h2'>Pets</p>
        <table class='table table-striped'>
            <thead class='table-success'>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
    </div>
    </main>
    <footer class="p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>