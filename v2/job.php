<?php
$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Home</title>

        <!-- Css File-->
         <link rel="stylesheet" href="./dist/css/style.min.css">
         <link rel="stylesheet"
         href="css.css">
     </head>
     <body>     
         <!-- Header Section strart-->
          <header class="header">
            <section class="flex">
                <div  class='bx bx-menu'   id="menu-btn"></div>
                <a href="Home.html" class="logo"> JobSearch </a>

                <nav class="navbar">
                    <a href="Home.html">Home</a>
                    <a href="About.html">About Us</a>
                    <a href="Bot.html">Bot</a>
                    <a href="Admin.php">Admin</a>

                </nav>
                <a href="Login.html" class="btn" style="margin-top:0% ;">Login</a>
            </section>
          </header>
<section class="jobs-container">

<h1 class="heading">The jobs</h1>

<div class="box-container"> 
   <?php
 $resultsPage= 6;
 $numberOfResult =$database->prepare("SELECT * FROM jobs");
 $numberOfResult->execute();
 $numberOfResult = $numberOfResult->rowCount();I   


 if(!isset($_GET['page'])){
    $page=1;
 }else if(isset($_GET['page'])){
    $page=$GET['page'];
 }
 
 $totalpage= ceil( $numberOfResult/$resultsPage);
 for($count=1;$count<= $totalpage;++$count){
    echo'<a herf="job.php?page='.$count.'">'.$count.'</a>';
 }
 
 $result=$database->prepare("SELECT * FROM jobs LIMIT". $resultsPage." OFFSET".($page-1) * $resultsPage);
 $getItem->execute();

         foreach($result AS $Result){   
       ?>    
      <div class="box">
         <div class="company">
            <img src="" alt="">
            <div>
               <h3><?php echo $Result['company_name']?></h3>
               <p><?php echo $Result['date_posted'] ?></p>
            </div>
         </div>
         <h3 class="job-titel"><?php echo $Result['job_title']?></h3>
         <p class="location">
         <span><?php echo $Result['location']?></span></p>
         <div class="tags">
            <p class="salary"><span><?php echo $Result['salary']?>$</span></p>
            <p class="job-type"><?php echo $Result['job_type']?></span></p>
         </div>
         <p class="description">
            <span><?php echo $Result['desciption']?></span></p>
         <div class="flex-btn">
            <a href="" class="btn">Appley</a>
            <button type="submit"></button>
         </div>

      </div> <?php }?>