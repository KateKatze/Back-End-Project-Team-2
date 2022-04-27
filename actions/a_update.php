<?php
session_start();
// if (isset($_SESSION['user']) != "") {
//     header("Location: ../../home.php");
//     exit;
// }

// if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//     header("Location: ../../index.php");
//     exit;
// }
require_once '../components/db_connect.php';
if ($_POST) {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $description = $_POST['description'];
    $prep_time = $_POST['prep_time'];
    $calories = $_POST['calories'];
    $diet = $_POST['diet'];
    $picture = $_POST['picture'];
    $url = $_POST['url'];
    $type = $_POST['type'];
    $id = $_POST['id'];
    
    $typeindex='';
    if ($type = 'breakfast') {
        $typeindex = 1;
    }
    if ($type = 'lunch') {
        $typeindex = 2;
    }
    if ($type = 'dinner') {
        $typeindex = 3;
    }

    $sql = "UPDATE recipe SET name = '$name', ingredients = '$ingredients', description = '$description', prep_time = $prep_time, calories = $calories, diet = '$diet', picture = '$picture', url = '$url', type = '$type', typeindex = $typeindex WHERE recipe_id ={$id}";

    // var_dump($sql);
    // exit();


    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Recipe info has been successfully updated!";
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
    }
    mysqli_close($connect);
} else {
    header("location: ../CRUD/error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../components/bootstrap.php' ?>
    <style>
        body {
            background-image: url(https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="card shadow p-2 w-70 mt-5 mb-5 p-4" style="width: 35rem" ;>
            <div>
                <h1 class="mb-4">Update status</h1>
            </div>
            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>

            </div>
            <a href='../recipes.php'><button class="btn btn-success border rounded" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>