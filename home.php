<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard

if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// echo ($result);
// exit;

$sql = "SELECT * FROM recipe";
$result = mysqli_query($connect, $sql);
$tbody = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "
        <div class='col'>
        <div class='card h-100 shadow justify-content-center'>
            <img src=" . $row['picture'] . " class='card-img-top' alt='" . $row['name'] . "'>
            <h4 class='card-title text-center mt-3'><i>" . $row['name'] . "</i></h4>
            <div class='d-flex flex-column mt-auto'>
            <div class='card-body'>
            <p class='card-text'><strong>Type:</strong> " . $row['type'] . " </p>
            <p class='card-text'><strong>Preparation time:</strong> " . $row['prep_time'] . "   </p>
            <p class='card-text'><strong>Calories</strong>: " . $row['calories'] . "   </p>
            <p class='card-text'><strong>Diet:</strong> " . $row['diet'] . "   </p>
            </div>
            </div>
            <div class='d-flex flex-column align-items-center justify-content-center'>
            <a href='details.php?id=" . $row['recipe_id'] . "' class='btn btn-success btn-sm cardbtn mt-3 mb-1' type='button'><span class='text-nowrap'>More Info</span></a>
            <a href='dateselect.php?id=" . $row['recipe_id'] . "&type=" . $row['type'] . "' class='btn btn-primary btn-sm cardbtn mb-2' type='button'><span class='text-nowrap'>Add to plan!</span></a>            
            </div></div>
        </div>";
    };
} else {
    $tbody =  "<tr><td colspan='8'><center>No Data Available</center></td></tr>";
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <script src="https://kit.fontawesome.com/34a8e65dca.js" crossorigin="anonymous"></script>
    <?php require_once 'components/bootstrap.php' ?>
    <style type="text/css">
        .img-thumbnail {
            width: 7rem !important;
            height: 7rem !important;
            position: absolute;
            margin-top: 4vh;
            margin-left: 1vw;
        }

        .container {
            width: 100% !important;
        }

        .manageProduct {
            margin: auto;
        }

        .col {
            position: relative;
        }

        .cardbtn {
            width: 18vw;
        }

        .card-img-top {
            width: auto !important;
            height: auto !important;
        }

        .card-body p {
            margin-bottom: 0.5rem;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        @media screen and (max-width: 2960px) {

            .cardbtn {
                width: 8vw !important;
            }
        }

        @media screen and (max-width: 1400px) {

            .cardbtn {
                width: 14vw !important;
            }
        }

        @media screen and (max-width: 850px) {

            .cardbtn {
                width: 18vw !important;
            }
        }

        @media screen and (max-width: 500px) {

            .cardbtn {
                width: 30vw !important;
            }
        }
    </style>
</head>

<body>
    <?php require_once 'navbar.php' ?>

    <div class="px-4 py-5 mb-5 text-center bordered shadow" style="background-image: url(https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg);
            background-size: cover;">
        <h1 class="display-5 fw-bold mt-4">MealPlanner menu</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Choose your favourite dishes and organize your day!</p>
            <div class="d-grid gap-2 d-flex justify-content-center">
                <form method="POST" action="actions/a_filter.php">
                    <select name="category" class="ps-4 pe-4 p-3 rounded shadow" style="background-color: #E6E7EB">
                        <option value="#">Your personal filter: </option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="regular">Regular</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="high-protein">High-protein</option>
                        <option value="low-carb">Low-carb</option>
                    </select>
                    <br>
                    <button class="btn btn-success btn-md mt-2" name="filter">Look for it!</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class='row row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-5'>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </div>
    </div>
    <?php require_once 'footer.php' ?>
</body>

</html>