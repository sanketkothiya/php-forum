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
    #quees {
        min-height: 433px;
    }
    </style>
</head>

<body>
    <?php  include 'partials/_dbconnect.php'?>
    <?php  include 'partials/_header.php'?>
    <?php

$id=$_GET['threadid'];
$sql="SELECT * FROM `threads` WHERE thread_id=$id";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{
    // $cid=$row['category_id'];
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];
    $thread_user_id1=$row['thread_user_id'];

    $sql3="SELECT user_email FROM `users` WHERE sno='$thread_user_id1' ";
    $result3=mysqli_query($conn,$sql3);
    $row3=mysqli_fetch_assoc($result3);
    $postedby=$row3['user_email'];
    
}

?>

<?php

$showalert=false;
      $method=$_SERVER["REQUEST_METHOD"];
    //   echo $method;
      if($method=='POST')
      {
    //      insert in to commnet db
          
          $comment=$_POST['comment'];
          $comment=str_replace("<","lt;",$comment );
          $comment=str_replace(">","gt;",$comment);
          $sno=$_POST['sno'];

          $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES 
          ('$comment', '$id', '$sno', current_timestamp())";
          $result=mysqli_query($conn,$sql);
          $showalert=true;
      }
      if($showalert)
      {
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Suceess</strong> Your comment has been added
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      }
?>




    <!-- category container start here -->
    <div class="container my-4">


        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $title; ?> forum</h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums./
                Do not post copyright-infringing material./
                Do not post “offensive” posts, links or images./
                Do not cross post questions./
                Do not PM users asking for help./
                Remain respectful of other members at all times.</p>
              
            <p>posted by:-<b><?php echo $postedby;  ?></b></p>

        </div>

    </div>

<input type="hidden">
    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
          echo '
          <div class="container">
          <h1>Post your comment</h1>
          <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
              
              <div class="form-group">
                  <label for="exampleFormControlTextarea1">Type your comment</label>
                  <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                  <input type="hidden" name="sno" value="'.$_SESSION["sno"].'"> 
  
              </div>
          
              
           
              <button type="submit" class="btn btn-success btn-md my-1">Post comment</button>
          </form>
      </div>';
      }
      else{

        echo '<div class="container">
        <p class="lead">
            You are not login please login for post comment!
        </p>
    </div>';

      }
    ?>
    



    <div class="container my-4" id="quees">
        <h1 class="my-2 my-2">Discussion</h1>
        <?php

            $nonresult=true;
            $id=$_GET['threadid'];
            $sql="SELECT * FROM `comments` WHERE thread_id=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
            $nonresult=false;
            $id=$row['comment_id'];
            $content=$row['comment_content'];
            $ctime=$row['comment_time'];
            $thread_user_id1=$row['comment_by'];

            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id1' ";
            $result2=mysqli_query($conn,$sql2);
            $row=mysqli_fetch_assoc($result2);
            
         
        


         echo  '<div class="media my-3" >
              <img  class="mr-2" src="partials/cuser.png" width="20px" alt="Generic placeholder image">
               <div class="media-body">

               <p><span style="font-weight:bold;">Asked by &nbsp;<mark>'.$row['user_email'].'</mark></span> <mark>'.$ctime.'</mark></p>

        
                '.$content.'
              <hr>
               
            </div>
        </div>';
     }
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