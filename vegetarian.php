<?php
session_start();
require_once 'components/db_connect.php';

// // if session is not set this will redirect to login page
// if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//     header("Location: index.php");
//     exit;
// }
// //if session user exist it shouldn't access dashboard.php
// if (isset($_SESSION["user"])) {
//     header("Location: home.php");
//     exit;
// }

$res = mysqli_query($connect, "SELECT name, picture, type ,calories ,recipe_id , prep_time , diet FROM recipe where diet = 'vegetarian'");
//$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$tbody = '';

// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
//         $tbody .= "<div class='col'>
//         <div class='card h-100 shadow justify-content-center'>
//             <img src=" . $row['picture'] . " class='card-img-top' alt='" . $row['name'] . "'>
//             <div class='card-body'>
//             <h4 class='card-title text-center'><i>" . $row['name'] . "</i></h5>
//             <p class='card-text mt-5'><strong>Type:</strong> " . $row['type'] . "   </p>
//             <p class='card-text'><strong>Preparation time:</strong> " . $row['prep_time'] . "   </p>
//             <p class='card-text'><strong>Calories</strong>: " . $row['calories'] . "   </p>
//             <p class='card-text'><strong>Diet:</strong> " . $row['diet'] . "   </p>
//             <div class='d-flex flex-column align-items-center justify-content-center'>
//             <span>" . "<a href='details.php?id=" . $row['recipe_id'] . "'><button class='btn btn-success btn-sm cardbtn mt-4 mb-1' type='button'><span class='text-nowrap'>More Info</span></button></a></span>
//             <span>" . "<a href='dateselect.php?id=" . $row['recipe_id'] . "'><button class='btn btn-primary btn-sm cardbtn mb-1' type='button'><span class='text-nowrap'>Add to meal plan!</span></button></a></span>
//             </div>
//             </div>
//             </div>
//         </div>";
//     };
// } else {
//     $tbody =  "<tr><td colspan='8'><center>No Data Available</center></td></tr>";
// }

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $tbody .= "
        <div class='col-lg-4 g-3'>
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
            </div>
            </div>
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
    <title>Recipes</title>
    <script src="https://kit.fontawesome.com/34a8e65dca.js" crossorigin="anonymous"></script>
    <?php require_once 'components/bootstrap.php'?>

    <style>
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
    <!-- Special navbar for admin with creating recipe function -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MealPlanner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="CRUD/create.php?">Create new recipe</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php?logout">Sign out</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container">
        <p class='h2 mt-5 mb-5'>Recipe collection</p>
            <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['recipe_id'] ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            </form>
            <div class='row row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-5'>
    <?= $tbody ?>
    </div>
    </div>
    
    <?php require_once 'footer.php'?>
</body>
</html>