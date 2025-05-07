<?php

session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']->user_type==="admin"){
       
      
    }else{
        echo'<div>Hello 2</div>';
       header("Location:Login.php",true);
        die("");
    }  
}else{
    echo'<div>Hello 3</div>';
    header("Location:Login.php",true);
    die("");
}
if(isset($_GET['submit'])){
    session_unset();
    session_destroy();
    header("Location:Login.php",true);
}


$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);

if(isset($_POST['add_job'])){
    $companyname = $_POST['company-name'];
    $jobname =$_POST['job-name'];
    $location =$_POST['location'];
    $salary =$_POST['salary'];
    $jobtype =$_POST['job-type'];
    $description =$_POST['description'];
    $companyimage =$_POST['company-image'];

    $addjob=$database->prepare("INSERT INTO jobs(company_name,job_title,location,salary,job_type,desciption)
    VALUES('$companyname',' $jobname ',' $location',' $salary ',' $jobtype', '$description')");
    if($addjob->execute()){echo "job add successfully";}else{echo "could not add the job";};
};


?>
<!-- saved from url=(0040)file:///C:/xampp/htdocs/Admin/Admin.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Manage job</title>

        <!-- Css File-->
         <link rel="stylesheet" href="css.css">
         <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    

     </head>
     <body>
        
         <!-- Header Section -->
          <header class="header">
            <section class="flex">
                <div class="bx bx-menu" id="menu-btn"></div>
                <a href="file:///C:/xampp/htdocs/Admin/Home.html" class="logo"><i class=""></i> JobSearch </a>

                <nav class="navbar">
                    <a href="file:///C:/xampp/htdocs/Admin/Admin.html">Manage job</a>
                    <a href="Application.php">Application</a>

                </nav>                   
                <form><button  type='submit'  name='submit' class='btn' >Logout</button></form>
        
            </section>
          </header>
          <div class="container">

            <div class="admin-job-form-container">
                <form action="" method="POST">
                      <h3>Add a New Job</h3>
                      <input type="text" placeholder="company name" name="company-name" maxlength="20" class="box">
                      <input type="text" placeholder="job title" name="job-name" maxlength="20" class="box">
                      <input type="text" placeholder="location" name="location" maxlength="20" class="box">
                      <input type="text" placeholder="Salary" name="salary" maxlength="20" class="box">
                      <input type="text" placeholder="Job type" name="job-type" maxlength="20" class="box">
                      <input type="text" placeholder="description" name="description" maxlength="500" class="box"> 
                      <div style="font-size: 1.8rem; color: #777;text-transform: capitalize;padding-left: 1rem;">Company image</div>
                      <input type="file" accept="img/png, img/jpeg, img/jpg" name="company-image" class="box">
                      <input type="submit" class="btn-admin" name="add_job" value="Add a job">
                </form>
            </div>

            <div class="job_disblay">
                <table class="job-disblay-table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Company Name</td>
                            <td>Location</td>
                            <td>Description</td>
                            <td>Salary</td>
                            <td>Job Type</td>
                            <td>Date Posted</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $getItem =$database->prepare("SELECT * FROM jobs");

                         $getItem->execute();
                        
                         foreach($getItem AS $Result){
                        ?>
                        
                         <td><?php echo $Result['job_title']?></td>
                         <td> <?php echo $Result['company_name']?></td>
                         <td><?php echo $Result['location']?></td>
                         <td><?php echo $Result['desciption']?></td>
                         <td><?php echo $Result['salary']?></td>
                         <td><?php echo $Result['job_type']?></td>
                         <td><?php echo $Result['date_posted'] ?></td>
                            
                             <td><img src="file:///C:/xampp/htdocs/Admin/Admin.html" height="100" alt=""></td>
                        <td>
                            <form method="POST">
                            <button class="btn-delete" name="delete" type="submit" value= "<?php echo $Result['job_id']?> ">Delete</button>
                            <a href="edit.php?edit=<?php echo $Result['job_id']?>" class="btn-edit">Edit</a></form>
                           
                        </td>
                         </tr>
                         <?php
                         };
                         if(isset($_POST['delete'])){
                            $removeJob = $database->prepare("DELETE FROM jobs WHERE job_id= :id");
                            $getId = $_POST['delete'];
                            $removeJob->bindParam("id",$getId);
                           
                          if($removeJob->execute()) {
                            header("refresh:0.5;");
                            echo'seccess';
                          } else{echo'not de';}
                          }
                        ?>
                 </tbody></table>

            </div>
          </div>
             <!-- js File
             <script src="file:///C:/xampp/htdocs/Admin/dist/js/script.min.js"></script>-->
            
     
</body></html>

       
                         