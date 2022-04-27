<?php
session_start();
require_once 'components/db_connect.php';


if (isset($_GET['id'])) {
  //    $sql = "SELECT * FROM recipe_manager JOIN recipe on
  //      recipe_manager.fk_recipe_id = recipe.recipe_id WHERE recipe_manager_id = {$_GET['id']}";
  $sql = "SELECT * FROM recipe WHERE recipe_id = {$_GET['id']}";
  $result = mysqli_query($connect, $sql);
  $body = "";
  if ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $body .= "<div class='col col-lg-6'>
    <img src='" . $row['picture'] . "' class=' img-responsive shadow mt-3 mb-5 bg-light rounded border border-secondary' class=important width= 550px ; height = 400px ; alt='...'>
    </div>
     
    <div class='col col-lg-6 col-md-8'>
    <div class='card-body shadow mt-3 mb-3 bg-light rounded '>
      <h3 class='card-title text-center'>Details</h3>
          <hr>
          <p class='card-text '><span class='fw-bold'>Course:</span> " . $row['type'] . "</p>
          <hr>
          <p class='card-text '><span class='fw-bold'>Preparation time:</span> " . $row['prep_time'] . " minutes</p>
          <hr>
          <p class='card-text'><span class='fw-bold'>Calories:</span> " . $row['calories'] . "</p>
          <hr>
          <p class='card-text'><span class='fw-bold'>Suitable diet:</span> " . $row['diet'] . "</p>
          <hr>
          <p class='card-text'><span class='fw-bold'>Ingredients:</span> " . $row['ingredients'] . "</p>
          <hr>
          <p class='card-text'><span class='fw-bold'>Description:</span> " . $row['description'] . "</p>
          <div class='row justify-content-between'>
          <div class='col-6'>
          <a href='".$row['url']."' style= 'color:black  ; text-decoration:none'><button class='btn btn-outline-secondary ' type='button'>Link to the recipe</button></a>
          </div>
         <div class='col-2'>
          <a href='home.php'  classtyle= 'color:black  ; text-decoration:none'><button class='btn btn-outline-secondary ' type='button'>Back</button></a>   
          </div>
          </div>
    </div> 
    </div>
    <hr class ='mt-4'>
       
      ";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
  <?php require_once 'components/bootstrap.php' ?>
  <title>Document</title>

  <script src="https://kit.fontawesome.com/34a8e65dca.js" crossorigin="anonymous"></script>
  <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
        } */
      
        .special {
            height: 180px;
        }
        a {
            text-decoration:none;
            color: black;
        }
        body {
            background: hsl(0, 0, 94%);
        }
        .carousel-control {
position: absolute;
top: 50%; /* pushes the icon in the middle of the height */
z-index: 5;
display: inline-block;
}
    </style>
</head>

<body>
  <?php require_once 'navbar.php' ?>
  <div class="container mt-5">
    <h1 class="mb-2 "><?php echo $name ?></h1>
    <div class="row">
      <?php echo $body ?>
    </div>
    <div class='container-fluid align-self-center height=250px  weight=250px '>
        <h4 class='align-self-start display-6'>Categories</span></h4>
        <div class='row'>
            <div class='col-10 align-self-center '><!--col4 is too tiny-->
                <div class='owl-carousel owl-theme'>
                    <div class='item mb-3'>
                        <div class='card border-1 shadow'>
                            <img src='https://images.immediate.co.uk/production/volatile/sites/30/2020/08/caponata-pasta-a0027c4.jpg?quality=90&webp=true&resize=200,170' alt=' class='special card-img-top'>
                            <div class='card-body'>
                                <div class='card-title text-center'>
                                  <a href='vegetarian.php'><h4>Vegetarian</h4></a><!--Insert the Link for the category-->
                                </div>
                            </div>
                        </div>
                    </div>
​
                    <div class='item'>
                        <div class='card border-1 shadow'>
                            <img src='https://images.immediate.co.uk/production/volatile/sites/30/2020/08/classic-lasange-4a66137.jpg?quality=90&webp=true&resize=200,170' alt=' class='special card-img-top'>
                            <div class='card-body'>
                                <div class='card-title text-center'>
                                  <a href='regular.php' value ="Regular"><h4>Regular</h4></a><!--Insert the Link for the category-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='item'>
                        <div class='card border-1 shadow'>
                            <img src='https://images.immediate.co.uk/production/volatile/sites/30/2020/08/raspberry-almond-oat-breakfast-cookies-c76041a.jpg?quality=90&webp=true&resize=200,170' alt=' class=' special card-img-top'>
                            <div class='card-body'>
                                <div class='card-title text-center'>
                                  <a href='low_carb.php'> <h4>Low Carb</h4></a><!--Insert the Link for the category-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='item'>
                      <div class='card border-1 shadow'>
                          <img src='https://images.immediate.co.uk/production/volatile/sites/30/2020/08/burrito-bowl-3629880.jpg?quality=90&webp=true&resize=200,170' alt=' class=' special card-img-top'>
                          <div class='card-body'>
                              <div class='card-title text-center'>
                                <a href='high_protein.php'> <h4>High Protein</h4></a><!--Insert the Link for the category-->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
​
  <?php require_once 'footer.php' ?>
</body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            mobileFirst: true,
            margin: 20,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
</body>

</html>

