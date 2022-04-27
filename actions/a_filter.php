<?php
require_once '../components/db_connect.php';



if (isset($_POST['filter'])) {
    $category = $_POST['category'];

    $sql = "SELECT * FROM recipe WHERE (type = '{$category}') OR (diet = '{$category}') ";
    $result = mysqli_query($connect, $sql);
    $typeOfCourse = '';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $typeOfCourse .= "<div class='col-lg-4 g-3'>
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
                <span>" . "<a href='../details.php?id=" . $row['recipe_id'] . "'><button class='btn btn-success btn-sm cardbtn mt-3 mb-1' type='button'><span class='text-nowrap'>More Info</span></button></a></span>
                <a href='../dateselect.php?id=" . $row['recipe_id'] . "&type=" . $row['type'] . "' class='btn btn-primary btn-sm cardbtn mb-2' type='button'><span class='text-nowrap'>Add to plan!</span></a>
               
                </div>
                </div>
            </div>";
        };
    } else {
        $typeOfCourse =  "<tr><td colspan='8'><center>No Data Available</center></td></tr>";
    }
}





mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/34a8e65dca.js" crossorigin="anonymous"></script>
    <?php require_once '../components/bootstrap.php' ?>
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
    <?php require_once '../navbar1.php' ?>

    <div class="container mt-5">

    <div class="manageProduct w-75 mt-3">
    <div class='row row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-5'>
            <tbody>
                <?= $typeOfCourse ?>
            </tbody>

        </div>
    </div>
    </div>

    <?php require_once '../footer.php' ?>
</body>
