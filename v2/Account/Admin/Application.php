<?php

$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);


  $getTtem=$database->prepare("SELECT users.name ,users.email ,jobs.job_title ,applications.date_applied FROM applications JOIN users on 
  users.user_id= applications.user_id JOIN jobs on jobs.job_id =applications.job_id ");
  $getTtem->execute();




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Application</title>

        <!-- Css File-->
         <link rel="stylesheet" href="css.css">
         <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    

     </head>
     <body>
        
         <!-- Header Section -->
          <header class="header">
            <section class="flex">
                <div  class='bx bx-menu'  id="menu-btn"></div>
                <a href="Home.html" class="logo"><i class=""></i> JobSearch </a>

                <nav class="navbar">
                    <a href="Admin.html">Manage job</a>
                    <a href="About.html">Application</a>
                </nav>
        
            </section>
          </header>
          <div class="container">


            <div class="job_disblay">
    <table class="job-disblay-table">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Job Title</td>
                <td>Company Name</td>
                <td>Date Applied</td>
            </tr>
        </thead>
        <tbody>
     <?php $getItem=$database->prepare("SELECT users.name ,users.email ,jobs.job_title ,jobs.company_name,applications.date_applied FROM applications JOIN users on 
           users.user_id= applications.user_id JOIN jobs on jobs.job_id =applications.job_id ");
           $getItem->execute();
           foreach($getItem AS $Result){         
            ?>
        <tr>
            <td><?php echo $Result['name']?></td>
            <td><?php echo $Result['email']?></td>
            <td><?php echo $Result['job_title']?></td>
            <td><?php echo $Result['company_name']?></td>
            <td><?php echo $Result['date_applied']?></td>
        </tr>
               <?php    } ?>
        </tbody>
    </table>

          </div>
          </div>
           <!-- js File-->
           <script src="./dist/js/script.min.js"></script>
     </body>
</html>