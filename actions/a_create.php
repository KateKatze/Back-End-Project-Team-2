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

if ($_POST) {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $description = $_POST['description'];
    $prep_time = $_POST['prep_time'];
    $calories = $_POST['calories'];
    $diet = $_POST['diet'];
    $url = $_POST['url'];
    $picture = $_POST['picture'];
    $type = $_POST['type'];
    $typeindex = '';

    if ($type = 'breakfast') {
        $typeindex = 1;
    }
    if ($type = 'lunch') {
        $typeindex = 2;
    }
    if ($type = 'dinner') {
        $typeindex = 3;
    }

    //this function exists in the service file upload.
    // $picture = file_upload($_FILES['picture']);

    $sql = "INSERT INTO recipe (recipe_id, name, ingredients, description, prep_time, calories, diet, url, picture, type, typeindex) VALUES (NULL, '$name', '$ingredients', '$description', $prep_time, $calories, '$diet', '$url', '$picture', '$type', $typeindex)";

    // var_dump($sql);
    // exit();




    // Run second query to insert data into recipe_manager table
    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $last_id = $connect->insert_id;
        if (isset($_SESSION['adm'])) {
            $val = $_SESSION['adm'];
        }
        if (isset($_SESSION['user'])) {
            $val = $_SESSION['user'];
        };

        $sql1 = "INSERT INTO recipe_manager (recipe_manager_id, fk_recipe_id, fk_user_id,  date) VALUES (NULL, $last_id, $val, NULL)";
        mysqli_query($connect, $sql1);


        $message = "Recipe was successfully created!";
        // $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Please try again: <br>" . $connect->error;
        // $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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

        .btn {
            width: 10vw;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="card shadow p-2 w-70 mt-5 mb-5 p-4" style="width: 35rem" ;>
            <div>
                <h1 class="mb-4">Create request response</h1>
            </div>
            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <a href='../dashboard.php'><button class="btn btn-success border rounded" type='button'>Home</button></a>
            </div>
        </div>
    </div>
</body>

</html>