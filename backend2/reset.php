<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Forgot Password</title>

        <!-- Css File-->
       <link rel="stylesheet" href="../dist/css/style.min.css">
         <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     </head>
     <body>
        
     <?php 
     if(!isset($_GET['code'])){
        echo' <div class="account-form-container">
            <section class="account-form">
            <form action="" method="POST">
                <h3>Forgot Password!</h3>
                <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input" >
                <input type="submit" value="Continue" name="submit" class="btn">
                

            </form >
             </section>
          </div>' ;

      } elseif(isset($_GET['code'])&& isset($_GET['email'])){
        echo' <div class="account-form-container">
            <section class="account-form">
            <form method="POST">
                <h3>New Password</h3>
                  <input type="password" required name="password" maxlength="20" placeholder="Create new password" class="input" >
                <input type="submit" value="Change" name="change" class="btn">
                
                
            </form>
             </section>
          </div>';

     }
     
     
     
     ?>   
     <?php 
     if( isset($_POST['submit'])){
        $username="root";
        $password="";
        $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );

        $chickEmail=$database->prepare("SELECT email,code FROM users WHERE email=:email");
        $chickEmail->bindParam("email", $_POST['email']);
        $chickEmail->execute();

        if($chickEmail->rowCount()>0){
            require_once 'mail1.php';
            $user=$chickEmail->fetchObject();
            $mail->addAdress( $_POST['email']);
            $mail->Subject="Rest password";
            $mail->Body= 'link for reset password <br>'
            .'<a href="http?email='. $_POST['email'].'&code='.$user->code.'">
            http?email='. $_POST['email'].'&code='.$user->code.'</a>';
            $mail->SetForm('abd.albasaleh.123@gmail.com', 'Job Website');
            $mail->send();
            echo 'A link has been sent to set the password';

        }else{
            echo 'This email not registed with us';
        }

     }
     ?>
     <?php  
     if(isset($_POST['change'])){
        $username="root";
        $password="";
        $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );
        $updatepassword=$database->prepare("UPDATE users WHERE SET password=:password WHERE email=:email");
        $updatepassword->bindParam("password",$_POST['change']);
        $updatepassword->bindParam("email",$_GET['email']);
    
        if($updatepassword->execute()){
            echo 'Password has been reset successfully';
        }else{
            echo 'Failed to set a password';}
        }



     ?>