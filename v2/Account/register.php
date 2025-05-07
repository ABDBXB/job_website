<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Register</title>

        <!-- Css File-->
        <link rel="stylesheet" href="css.css">
         <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     </head>
     <body>
         
          <!--account section starts-->
          <div class="account-form-container">
            <section class="account-form">
            <form action="" method="POST">
                <h3>Creat New Account!</h3>
                <input type="text" required name="name" maxlength="20" placeholder="enter your name" class="input" >
                <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input" >
                <input type="password" required name="pass" maxlength="20" placeholder="enter your password" class="input" >
                <input type="password" required name="c_pass" maxlength="20" placeholder="confirm your password" class="input" >
                <p>already have an account? <a href="Login.php" >Login now</a></p>
                <input type="submit" value="register" name="submit" class="btn">

            </form>
             </section>
          </div>
          <!--account section end-->
     </body>



     <?php
     
    $username="root";
    $password="";
    $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );
   

    if(isset($_POST['submit'])){ 
    $checkEmail=$database->prepare("SELECT *FROM users WHERE email=:email ");
    $email = $_POST['email'];
    $checkEmail->bindParam("email",  $email);
    $checkEmail->execute();

      if($checkEmail->rowCount()>0){
        echo'<div>This account alrady exists </div>';
      }
      else{
        $name= $_POST['name'];
        $email= $_POST['email'];
        $password= $_POST['pass'];
        $c_password= $_POST['c_pass'];

        $addusers=$database->prepare("INSERT INTO users(name,email,password,code) VALUES(:name,:email,:password,:code) ");
        $addusers->bindParam("name", $name);
        $addusers->bindParam("email", $email);
        $addusers->bindParam("password",$password);
        $code=md5(date("h:i:s"));
        $addusers->bindParam("code",$code);
        if($addusers->execute()){
             echo'<div>An account has been created successfully </div>';
             require_once "mail.php";
             $mail->addAdress($email);
             $mail->Subject="Email verification code";
             $mail->Body= '<h1>Thank you for registering on our website </h>'
             ."<div> Account verification link "."<div>".
             "<a href='active.php?code=".$code."'>". "active.php"."?code=" .$code."</a>";
             $mail->SetForm("sulafakh22@gmail.com" , "JOBSearch");
             $mail->send();
        }
        else{
            echo'<div>Something went Wrong</div>';
        }
        }

       
      }

    ?>