<?php
// session_start();

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../../home.php");
//     exit;
// }

// if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//     header("Location: ../../dashboard.php");
//     exit;
// }

require_once '../components/db_connect.php';

if ($_GET) {
    $id = $_GET['id'];
    $sql = "DELETE FROM meal_plan WHERE fk_recipe_id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";

        // var_dump($sql);
        // exit();
    } else {
        $class = "danger";
        $message = "Recipe info was not deleted due to: <br>" . $connect->error;
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
    <title>Delete recipe</title>
    <?php require_once '../components/bootstrap.php' ?>
    <style>
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
        <div class="card shadow p-2 w-70 mt-5 mb-5 p-4" style="width: 35rem" ;>
            <div>
                <h1 class="mb-4">Delete recipe from my planner</h1>
            </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= $message; ?></p>
            </div>
            <a href='../mealplan.php'><button class="btn btn-success border rounded" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>