<?php
session_start();

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../../home.php");
//     exit;
// }

// if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//     header("Location: ../../dashboard.php");
//     exit;
// }
require_once '../components/db_connect.php';
$error = false;
$mealError = '';

if ($_POST) {
    $date = $_POST['date'];
    $id = $_POST['recipe_id'];
    $type = $_POST['type'];

    if (isset($_SESSION['adm'])) {
        $val = $_SESSION['adm'];
    }
    if (isset($_SESSION['user'])) {
        $val = $_SESSION['user'];
    };

    $query = "SELECT meal_plan.date, meal_plan.fk_users_id, recipe.type FROM meal_plan join recipe on meal_plan.fk_recipe_id = recipe.recipe_id where meal_plan.date = '$date' AND recipe.type = '$type'";

    // var_dump($query);
    // exit();

    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);

    if ($count != 0) {
        $error = true;

        if ($type == "breakfast") {
            $class = "danger";
            $mealError = "Breakfast has already been chosen for this date. Select different meal type.";
        }
        if ($type == "lunch") {
            $class = "danger";
            $mealError = "Lunch has already been chosen for this date. Select different meal type.";
        }
        if ($type == "dinner") {
            $class = "danger";
            $mealError = "Dinner has already been chosen for this date. Select different meal type.";
        } else {
            $class = "danger";
            $mealError = "You have already planned your menu for this date";
        }
    }

    // 2. type found in query (if its the same that user is trying to insert? -> stop + msg "cannot insert, coz type exists at that day" if the if-statement is false -> allows to insert) 1. before the if-statements check the number of rows > 0 and if its 0 -> user can insert meal 

    if (!$error) {

        $sql = "INSERT INTO meal_plan (meal_plan_id, fk_users_id, fk_recipe_id,  date, fk_recipe_manager_id) VALUES (NULL, $val, $id, '$date', NULL)";

        if (mysqli_query($connect, $sql) === true) {
            $class = "success";
            $message = "Meal successfully added to your meal planner!";
        } else {
            $class = "danger";
            $message = "Error while creating record. Please try again: <br>" . $connect->error;
        }
    }
}
mysqli_close($connect);
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

        .btn {
            width: 10vw;
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
                <p><?php echo ($mealError) ?? ''; ?></p>
            </div>
            <a href='../recipes.php'><button class="btn btn-success border rounded" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>