<?php
session_start();

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../home.php");
//     exit;
// }

// if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//     header("Location: ../dashboard.php");
//     exit;
// }


require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM recipe WHERE recipe_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {

        $name = $data['name'];
        $ingredients = $data['ingredients'];
        $description = $data['description'];
        $prep_time = $data['prep_time'];
        $calories = $data['calories'];
        $diet = $data['diet'];
        $url = $data['url'];
        $picture = $data['picture'];
        $type = $data['type'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Recipe</title>
    <?php require_once '../components/bootstrap.php' ?>
    <style type="text/css">
        .img-thumbnail {
            width: 120px !important;
            height: 120px !important;
        }
        body {
            background-image: url(https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
<div class="container d-flex justify-content-center">
    <div class="card shadow w-70 mt-5 mb-5 p-5" style="width: 35rem";>
    <fieldset>
        <legend class='h2'>Delete request <br><br><img class='img-thumbnail rounded mb-3' src='<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        
        <p>You have selected the data below:</p>
        <table class="table w-75 mt-3">
            <tr>
                <td><?php echo $name ?></td>
            </tr>
        </table>
        <br>
        <h5 class="mb-4">Delete this recipe´s info?</h5>
        <form action="../actions/a_delete.php" method="post">
            <input type="hidden" name="recipe_id" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            <button class="btn btn-danger" type="submit">Yes</button>
            <a href="../dashboard.php"><button class="btn btn-success" type="button">Cancel</button></a>
        </form>
    </fieldset>
    </div>
    </div>
</body>

</html>