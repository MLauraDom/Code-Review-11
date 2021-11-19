<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id1 = $_SESSION['adm'];
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $id1);
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);

$class = 'd-none';


if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $fname = $data['fname'];
        $lname = $data['lname'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $picture = $data['picture'];
    }
}
//the POST method will actually delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "avatar.png") ?: unlink("pictures/users/$picture");

    $sql = "DELETE FROM user WHERE id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted!";
        header("refresh:3;url=dashboard.php");
    } else {
        $class = "alert alert-danger";
        $message = "The entry was not deleted due to: <br>" .             $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR11-LauraMoldovan - Delete User</title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" type='text/css' href="css/style.css" />
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
    <header class="hero p-3">
        <h3>
            Logged is as <?php echo $row1['fname'] . " " . $row1['lname'] ?> - Admin
        </h3>
        <h1 class="text-center">
            Delete user <?php echo $fname . " " . $lname ?>
        </h1>
    </header>
    <main class="p-5">
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
        </div>
        <fieldset>
            <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='pictures/users/<?php echo $picture ?>' alt="<?php echo $fname ?>"></legend>
            <h5>You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <td><?php echo "$fname $lname" ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $address ?></td>
                </tr>
            </table>

            <h3 class="mb-4">Do you really want to delete this user?</h3>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="dashboard.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
            </form>
        </fieldset>
    </main>
    <footer class="p-5 bg-info">
        <p class="h4 text-center text-white">Made by <a href="#">&#x24B8Laura Moldovan</a></p>
    </footer>
</body>

</html>