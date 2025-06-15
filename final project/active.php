<?php 
if(isset($_GET['code'])){
    
 $username="root";
 $password="";
 $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );

$checkCode=$database->prepare("SELECT code FROM users WHERE code=:code ");
$checkCode->bindParam("code",$_GET['code']);
$checkCode->execute();
if($checkCode->rowCount()>0){
$update= $database->prepare("UPDATE users SET code=:newcode , activated=true WHERE  code=:code");
$code=rand(100000, 999999);
$update->bindParam("newcode",$code);
$update->bindParam("code",$_GET['code']);
if($update->execute()){
    echo'<div>The account has been verified.</div>';
    echo' <div class="account-form-container">
            <section class="account-form">
            <form action="" method="post">
                <h3></h3>
                <input type="submit" value="Login Now" name="submit" herf="login.php" class="btn">
                

            </form>
             </section>
          </div>';
}else{
echo'<div>Something went Wrong</div>';
}
}
}
?>
<div class="account-form-container">
            <section class="account-form">
            <form action="" method="post">
                <h3></h3>
                <input type="submit" value="Login Now" name="submit" herf="login.php" class="btn">
                

            </form>
             </section>
          </div>'