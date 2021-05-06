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
    #ques {
        min-height: 433px;
    }

    body {
        background-color: darkgray;
    }
    </style>
</head>

<body>
    <?php  include 'partials/_dbconnect.php'?>
    <?php  include 'partials/_header.php'?>
    <?php

            $id=$_GET['catid'];
            $sql="SELECT * FROM `categories`WHERE category_id=$id ";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result))
            {
                // $cid=$row['category_id'];
                $catname=$row['category_name'];
                $descname=$row['category_description'];
            }

    ?>
    <?php

$showalert=false;
      $method=$_SERVER["REQUEST_METHOD"];
    //   echo $method;
      if($method=='POST')
    //   insert in to thread db
      {    
          $th_title=$_POST['title'];
          $th_desc=$_POST['desc'];
          $sno=$_POST['sno'];

          $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES 
          ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
          $result=mysqli_query($conn,$sql);
          $showalert=true;
      }
      if($showalert)
      {
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Suceess</strong> Your thread has been added
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      }
?>



    <!-- category container start here -->
    <div class="container my-4">


        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forum</h1>
            <p class="lead"><?php echo $descname; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p>posted by:<b>Sanket</b></p>
            <p class="lead">
                <a class="btn btn-success btn-md" href="#" role="button">Learn more</a>
            </p>
        </div>

    </div>

    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
          echo '
    <div class="container">
        <h1>Start a discussion</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    placeholder="Enter your problem title here">
                <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as possible
                </small>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'"> 
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborat your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-md my-1">Submit</button>
        </form>
    </div>';
      }
      else{

        echo '<div class="container">
        <p class="lead">
            You are not login please login for start discussion!
        </p>
    </div>';

      }
    ?>

    <div class="container my-4" id="ques">
        <h1>Browse questions</h1>

        <?php

        //  $id=$_GET['catid'];
         $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result=mysqli_query($conn,$sql);
        $nonresult=true;

        while($row=mysqli_fetch_assoc($result))
        {
            $nonresult=false;
            // $id=$_GET['catid'];
            $id=$row['thread_id'];
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $thraeadtime=$row['timestamp'];
            $thread_user_id=$row['thread_user_id'];

            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id' ";
            $result2=mysqli_query($conn,$sql2);
            $row=mysqli_fetch_assoc($result2);
            


         echo  '<div class="media my-3">
              <img class="mr-3" src="partials/users.png" width="40px"   alt="Generic placeholder image">
               <div class="media-body">
               <p><span style="font-weight:bold;">Asked by &nbsp;<mark>'.$row['user_email'].'</mark></span> &nbsp;<mark>'.$thraeadtime.'</mark></p>
                <h5 class="mt-0"><a  class="text-dark" href="threadcat.php?threadid='.$id.'">'.$title.'</a></h5>
                '.$desc.'
              
               <hr>
            </div>
        </div>';
     }
            // echo var_dump($noresult);
            if($nonresult)
            {
                    echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <p class="display-4">No person found </h1>
                    <hr>
                    <p class="lead">Be the first person to ask the quetions</p>
                    </div>
                </div>';
            }
        ?>

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