<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE users_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $fname = $data['first_name'];
        $lname = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];
        $image = $data['image'];
    } else {
        header("location: ../CRUD/error.php");
    }
    mysqli_close($connect);
} else {
    header("location: ../CRUD/error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update user info</title>
    <?php require_once '../components/bootstrap.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
        }

        .img-thumbnail {
            width: 140px !important;
            height: auto !important;
        }
        body {
            background-image: url(https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .btn {
            width: 10vw;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
    <div class="card shadow w-70 mt-5 mb-5 p-5" style="width: 35rem";>
    <fieldset>
        <legend class='h2 mb-2'>Update user info<br></legend>
        <img class='img-thumbnail rounded mt-4 mb-3' src='<?php echo $image ?>' alt="<?php echo $fname ?>">
        <br>
        <form action="action/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>First name</th>
                    <td><input class="form-control" type="text" name="fname" placeholder="First name" value="<?php echo $fname ?>" /></td>
                </tr>
                <tr>
                    <th>Last name</th>
                    <td><input class="form-control" type="text" name="lname" placeholder="Last name" value="<?php echo $lname ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input class="form-control" type="text" name="password" placeholder="Age" value="<?php echo $password ?>" /></td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><input class="form-control" type="text" name="image" placeholder="Image" value="<?php echo $image ?>" /></td>
                </tr>
                             
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['users_id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['image'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save</button></td>
                    <td><a href="../dashboard.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
    </div>
    </div>
</body>
</html>