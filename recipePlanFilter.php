<?php
require_once 'components/db_connect.php';



 if(isset($_POST['filter'])){
    $category=$_POST['category'];
    
    $sql = "SELECT recipe.type, recipe.diet,users.users_id 
    FROM recipe, users
    WHERE 'users.users_id' = 'recipe.recipe_id' AND 'recipe.type' = '{$category}'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $typeOfCourse ='';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $typeOfCourse .= "<div class='col'>
            <div class='card h-100 shadow justify-content-center'>
                <img src=" . $row['picture'] . " class='card-img-top' alt='" . $row['name'] . "'>
                <div class='card-body'>
                <h4 class='card-title text-center'><i>" . $row['name'] . "</i></h5>
                <p class='card-text mt-5'><strong>Type:</strong> " . $row['type'] . "   </p>
                <p class='card-text'><strong>Preparation time:</strong> " . $row['prep_time'] . "   </p>
                <p class='card-text'><strong>Calories</strong>: " . $row['calories'] . "   </p>
                <p class='card-text'><strong>Diet:</strong> " . $row['diet'] . "   </p>
    
                <div class='d-flex flex-column align-items-center justify-content-center'>
                <span>" . "<a href='details.php?id=" . $row['recipe_id'] . "'><button class='btn btn-success cardbtn mt-4 mb-1' type='button'><span class='text-nowrap'>More Info</span></button></a></span>
                <a href='CRUD/delete.php?id=" . $row['recipe_id'] . "'><button class='btn btn-danger cardbtn' type='button'><span class='text-nowrap'>Delete</span></button></a></td>
                </div>
                </div>
                </div>
            </div>";
        };
    }
    else {
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

        .hero {
            width: 100% !important;
            height: 28vh;
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(37, 201, 156, 1) 0%, rgba(0, 255, 181, 0.8337710084033614) 100%);
        }

        .manageProduct {
            margin: auto;
        }

        .col {
            position: relative;
        }

        .cardbtn {
            width: 9vw;
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

        .custom {
            width: 60px;
        }
    </style>
</head>

<body>
    <?php require_once 'navbar.php' ?>

   
        <div class="manageProduct w-75 mt-3">
        <div class='row row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-5 mb-4'>
            <tbody>
                <?=$typeOfCourse ?>
            </tbody>
          
        </div>
    </div>
      
        <div class=' w-50 mb-4 d-flex justify-content-end' style='margin-top: 4vh; margin-bottom: 2vh;'>
                <a href="home.php"><button class='btn btn-success text-white' type="button">Back</button></a>
            </div>
    </div>
    <?php require_once 'footer.php' ?>
</body>
