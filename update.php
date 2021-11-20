<?php
session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
// if session is not set this will redirect to login page
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

if (!isset($_SESSION['adm']) && isset($_SESSION['user'])) {

    $res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
} else if (isset($_SESSION['adm']) && !isset($_SESSION['user'])) {

    $res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['adm']);
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $fname = $data['fname'];
        $lname = $data['lname'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $picture = $data['picture'];
    }
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $picture = $_POST['picture'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialized
    $uploadError = '';
    $pictureArray = file_upload($_FILES['picture']); //file_upload() called
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {
        ($_POST["picture"] == "avatar.png") ?: unlink("pictures/users/{$_POST["picture"]}");
        $sql = "UPDATE user SET fname = '$fname', lname = '$lname', email = '$email', address = '$address', phone = '$phone', picture = '$pictureArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE user SET fname = '$fname', lname = '$lname', email = '$email', address = '$address', phone = '$phone', WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR11-LauraMoldovan - Edit User</title>
    <link rel="stylesheet" type='text/css' href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Great+Vibes&display=swap" rel="stylesheet">
    <?php require_once 'components/boot.php' ?>
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
                                <a class="nav-link" href="home.php">
                                    HOME
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="update.php?id=<?php echo $row1['id'] ?>">
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
                Welcome, <?php echo $fname." ".$lname."!" ?>
            </h3>
            <h1 class="text-center">
                Update your Info!
            </h1>
        </div>
    </header>
    <main class="p-5">
        <div class="container">
            <div class="<?php echo $class; ?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
            </div>

            <h2>Update</h2>
            <img class='img-thumbnail rounded-circle' src='pictures/users/<?php echo $data['picture'] ?>' alt="<?php echo $fname ?>">
            <form method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <td><input class="form-control" type="text" name="fname" placeholder="First Name" value="<?php echo $fname ?>" /></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input class="form-control" type="text" name="lname" placeholder="Last Name" value="<?php echo $lname ?>" /></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><input class="form-control" type="text" name="address" placeholder="Address" value="<?php echo $address ?>" /></td>
                    </tr>
                    <tr>
                        <th>Phone number</th>
                        <td><input class="form-control" type="text" name="phone" placeholder="Phone number" value="<?php echo $phone ?>" /></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class="form-control" type="file" name="picture" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                        <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                        <td><button name="submit" class="btn btn-success" type="submit">Save Changes</button></td>
                        <td><a href="<?php echo $backBtn ?>"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
    <footer class="p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>