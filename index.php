<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>IFORUM</title>
    <style>
    a {
text-decoration: none;
    
    }
    a:hover{
        text-decoration:underline;
    }
    body{
        background-color:darkgray;
    }

    #ques{
min-height: 433px;
}

   

    </style>
</head>

<body>
    <?php  include 'partials/_dbconnect.php'?>
    <?php  include 'partials/_header.php'?>




    <!-- slider strart here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="partials/1.jpg" height="50%" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="partials/2.jpg" height="50%" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="partials/3.jpg" height="50%" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>


    <!-- category container start here -->
    <div class="container my-4" id="ques">
        <h2 class="text-center my-4">
            IFORUM- CATEGORIES
        </h2>
        <div class="row my-4">
            <!-- fetch all categories -->
            <?php

                    $sql="SELECT * FROM `categories` ";
                    $result=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $cid=$row['category_id'];
                        $cat=$row['category_name'];
                        $desc=$row['category_description'];
                        // echo $row['category_id'];
                        // echo $row['category_name'];
                            echo 
                        '<div class="col-md-4  my-2">


                            <div class="card" style="width: 18rem;">
                                <img src="img/card-'.$cid.'.jpg" height="200" class="card-img-top"
                                    alt="wait just a sec">
                                    <h5 class="card-title" mx-1 my-1 > <a  href="threads.php?catid='.$cid.'" > '.$cat.'  </h5></a>
                                <div class="card-body">
                                    <p class="card-text">'.substr($desc,0,90).'...</p>
                                    <a href="threads.php?catid='.$cid.' " class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>';
                             
                    }

            ?>

        </div>
    </div>

    <?php  include 'partials/_footer.php'?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>