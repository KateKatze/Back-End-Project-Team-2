<?php
session_start();
require_once "components/db_connect.php";

if (isset($_SESSION['adm'])) {
    $val = $_SESSION['adm'];
}
if (isset($_SESSION['user'])) {
    $val = $_SESSION['user'];
};

$sql = "SELECT meal_plan.*, recipe.picture, recipe.name, recipe.type, recipe.calories, recipe.prep_time, recipe.diet FROM meal_plan JOIN recipe ON meal_plan.fk_recipe_id = recipe.recipe_id WHERE meal_plan.fk_users_id = $val ORDER BY date, typeindex asc";
// var_dump($sql);
// exit();
$result = mysqli_query($connect, $sql);

$tbody = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr>
                <td><img class='img-thumbnail' src='" . $row['picture'] . "'</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['calories'] . "</td>
                <td>" . $row['prep_time'] . "</td>
                <td>" . $row['diet'] . "</td>
                <td>" . $row['type'] . "</td>
                <td>" . $row['date'] . "</td>
                <td><a href='details.php?id=" . $row['fk_recipe_id'] . "'><button class='btn btn-primary btn-sm w-100 mb-2' type='button'>Info</button></a>
                <a href='actions/a_mealplan_delete.php?id=" . $row['fk_recipe_id'] . "'><button class='btn btn-danger btn-sm w-100' type='button'>Delete from plan</button></a></td>
                </tr>";
    }
} else {
    $tbody = "<tr><td colspan='8'><center>No Data Available</center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your meal plan</title>

    <?php require_once 'components/bootstrap.php' ?>
    <style type="text/css">
        .manageProduct {
            margin: auto;
            width: 90%;
        }

        .img-thumbnail {
            width: 8vw !important;
            height: auto !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
        }
        body {
            background-image: url(https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
<?php require_once 'navbar.php' ?>
    <div class="manageProduct bg-light rounded mt-3 p-1">
        <p class='mt-4 mb-4 display-6 ps-3'>Your Meal plan</p>
        <div style="overflow-x:auto;">
        <table class='table table-striped'>
            <thead class='table-secondary text-nowrap'>
                <tr>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Picture</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Recipe name</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Calories</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Preparation Time</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Diet</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Type</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Weekday</th>
                    <th class='h5' style='padding-top: 4vh; padding-bottom: 4vh;'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>

</html>