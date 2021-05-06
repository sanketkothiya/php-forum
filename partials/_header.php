<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/forum">IFORUM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';



                             $sql= "SELECT 	category_name,category_id FROM `categories`";
                             $result=mysqli_query($conn,$sql);
                              while($row=mysqli_fetch_assoc($result))
                                {
                                    // $cid=$row['category_id'];
                                    // $catname=$row['category_name'];
                                    // $descname=$row['category_description'];

                                    echo'<li><a class="dropdown-item" href="threads.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
                                }

                          



                            echo'
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                </ul>
                <div class="row mx-2">';

                 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
                 {
                     echo'<form class="d-flex" method="get" action="search.php" >
                     <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                     <button class="btn btn-success" type="submit">Search</button>
                     <p class="text-light mx-2 my-2">welcome&nbsp;' .$_SESSION['useremail']. '</p>
                     <a href="partials/_logout.php" class="btn btn-outline-success" type="submit">logout </a>
                     ';
                     

                 }
                 else
                 {
                     echo'
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>

                        <button type="button" class="btn btn-outline-success mx-3" data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
                        <button  type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">signup</button>
                  
                  
                      </form>';
                    
                 }
                  
               
         echo'
         </div>
         </div>
         </nav>';




        include 'partials/_loginModal.php';
        include 'partials/_signupModal.php';
        if(isset($_GET['signupsuccess']) && $signupsuccess="true")
        {
            echo'
            <div class="alert alert-success alert-dismissible fade show my-0" role="alert" >
  <strong>Holy guacamole!</strong> Now you can login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        }
        
     ?>