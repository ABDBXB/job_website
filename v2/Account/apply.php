<?php 



if(!isset($_SESSION['user'])){
    header("Location:login.php");
    exit();
}else{

$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);

if(isset($_POST['apply'])){
    $user_id=$_SESSION['user_id'];
    $job_id=$_POST['job_id'];
    echo"تم ";

    try{
        $Check_apply=$database->prepare("SELECT * FROM applications WHERE user_id=? AND job_id=?");
        $Check_apply->execute([$user_id,$job_id]);
        if($Check_apply->rowCount()>0){
            $_SESSION['error']="You applied for this job";
            header("Location:Home.php?job_id=".$job_id);
            exit();

        }
        $apply=$database->prepare("INSERT INTO applications (user_id,job_id,date_applied) VALUES(?,?,NOW())");
        $apply->execute([$user_id,$job_id]);
        $_SESSION['success']="You apple success";
        header("Location:Home.php?job_id=".$job_id);
        exit();
    }catch(PDOExection $e){
        $_SESSION['error']="error".$e->getMessage();
        header("Location:Home.php?job_id=".$job_id);
        exit();

    }
}
}




?>