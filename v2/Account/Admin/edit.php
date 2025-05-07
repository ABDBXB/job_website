<?php

$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);

if(isset($_GET['edit'])){
    $getjobs=$database->prepare("SELECT * FROM jobs WHERE job_id=:job_id ");
    $getjobs->bindParam("job_id",$_GET['edit']);
    $getjobs->execute();
foreach($getjobs AS $Result){
        echo' <div class="container">
         <div class="centered">
            <div class="admin-job-form-container ">
                <form action="" method="POST" enctype="multipart/form-data">
                      <h3>Update the Job</h3>
                      
                      <input type="text" placeholder="company name"  name="company_name" value="'.$Result['company_name'].'" class="box">
                      <input type="text" placeholder="job title" name="job_title"  value="'.$Result['job_title'].'" class="box">
                      <input type="text" placeholder="location" name="location"  value="'.$Result['location'].'" class="box">
                      <input type="text" placeholder="Salary" name="salary"  value="'.$Result['salary'].'" class="box">
                      <input type="text" placeholder="Job type" name="job_type"  value="'.$Result['job_type'].'" class="box">
                      <input type="text" placeholder="description" name="desciption" value="'.$Result['desciption'].'" class="box"> 
                      <input type="file" accept="img/png, img/jpeg, img/jpg" name="company-image" class="box">
                     <button class="btn-admin" name="update" type="submit" value= "'.$Result['job_id'].' ">update</button>
                      <a href="Admin.php" class="btn-admin">Back</a>
                </form>
            </div>
        </div>';
    }
    if(isset($_POST['update'])){
      $update=$database->prepare("UPDATE jobs SET company_name=:company_name ,job_title=:job_title,location=:location,
      salary=:salary,job_type=:job_type,desciption=:desciption WHERE job_id=:id");
      $update->bindParam("company_name",$_POST['company_name']);
      $update->bindParam("job_title",$_POST['job_title']);
      $update->bindParam("location",$_POST['location']);
      $update->bindParam("salary",$_POST['salary']);
      $update->bindParam("job_type",$_POST['job_type']);
      $update->bindParam("desciption",$_POST['desciption']);

      $getId=$_POST['update'];
      $update->bindParam("id",$getId);
      $update->execute();
      header("refresh:0.5;");
     
    }    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Update</title>

        <!-- Css File-->
         <link rel="stylesheet" href="css.css">
         <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     </head>
     <body>
       
     </body>
</html>