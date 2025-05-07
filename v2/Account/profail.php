<link rel="stylesheet" href="css.css">



<?php 
session_start();
if(isset($_SESSION['user'])){
    echo'<div class="account-form-container">
            <section class="account-form">
            <form action="" method="POST">
                <h3>Profail</h3>
                <input type="text" required name="name"  value="'.$_SESSION['user']->name.'" placeholder="enter your name" class="input" >
                <input type="email" required name="email" value="'.$_SESSION['user']->email.'" placeholder="enter your email" class="input" >
                <input type="text" required name="pass" value="'.$_SESSION['user']->password.'" placeholder="enter your password" class="input" >
                <button type="submit" value="'.$_SESSION['user']->user_id.'" name="submit" class="btn">update</button>

            </form>
             </section>
          </div>';
 if(isset($_POST['submit'])){
    $username="root";
    $password="";
    $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );

    $updateUserData =$database->prepare("UPDATE users SET name=:name,
     email=:email ,password=:password WHERE user_id=:id");
     $updateUserData->bindParam('name',$_POST['name']);
     $updateUserData->bindParam('email',$_POST['email']);
     $updateUserData->bindParam('password',$_POST['pass']);
     $updateUserData->bindParam('id',$_POST['submit']);
     if($updateUserData->execute()){
        echo'<div>تم التحديث</div>';
        $user=$database->prepare("SELECT*FROM users WHERE user_id=:id");
        $user->bindParam('id',$_POST['submit']);
        $user->execute();
        $_SESSION['user']=$user->fetchObject();
        header("refresh:2;");
     }else{
        echo'<div>لم يتم التحديث</div>';
     }
 }

}
?>