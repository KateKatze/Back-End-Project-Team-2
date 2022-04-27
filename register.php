<?php
session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

require_once 'components/db_connect.php';

$error = false;
$fname = $lname = $email = $pass = $picture = '';
$fnameError = $lnameError = $emailError = $passError = $picError = '';

if (isset($_POST['btn-signup'])) {

    // sanitise user input to prevent sql injection, trim - strips whitespace (or other characters) from the beginning and end of a string, strip_tags -- strips HTML and PHP tags from a string, htmlspecialchars converts special characters to HTML entities
    $fname = trim($_POST['first_name']);
    $fname = strip_tags($fname);
    $fname = htmlspecialchars($fname);

    $lname = trim($_POST['last_name']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $picture = trim($_POST['image']);
    $picture = strip_tags($picture);
    $picture = htmlspecialchars($picture);

    // basic name validation
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your name";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces";
    }

    // basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address";
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided e-mail is already in use";
        }
    }

    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters";
    }

    // password hashing for security
    $password = hash('sha256', $pass);

    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users (first_name, last_name, email, password, image, user_status)
        VALUES('$fname', '$lname', '$email', '$password', '$picture', 'user')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "New person was successfully registered, you may login now";
            // $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Ooops! Something went wrong. Please try again.";
            // $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
    <?php require_once 'components/bootstrap.php' ?>
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
        <form class="card shadow p-5 w-70" style="margin-top: 5vh; margin-bottom: 5vh;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <h2 class="display-5 text-center">Welcome to MealPlanner!</h2>
            <p class="lead mt-3 text-center">Please, sign up to the system</p>
            <hr />
            <?php
            if (isset($errMSG)) {
            ?>
                <div class="alert alert-<?php echo $errTyp ?>">
                    <p><?php echo $errMSG; ?></p>
                </div>

            <?php
            }
            ?>

            <input type="text" name="first_name" class="form-control" placeholder="First name" maxlength="50" value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>
            <br>
            <input type="text" name="last_name" class="form-control" placeholder="Last name" maxlength="50" value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>
            <br>
            <input type="email" name="email" class="form-control" placeholder="E-mail" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>
            <br>
            <input type="password" name="password" class="form-control" placeholder="Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <br>
            <input type="text" name="image" class="form-control" placeholder="Link on the image (URL)" maxlength="50" value="<?php echo $picture ?>" />
            <span class="text-danger"> </span>
            <hr />
            <button type="submit" class="btn btn-md btn-primary" name="btn-signup">Sign Up</button>
            <hr />
            <p class="lead">Already registered?</p>
            <a class="btn btn-success" href="index.php">Sign in</a>
        </form>
    </div>
</body>

</html>