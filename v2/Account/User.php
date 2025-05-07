<?php 
session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']->user_type==="user"){
        echo'<div>Hello '.$_SESSION['user']->name.'</div>';
        echo'<a href="profail.php" >profail</a>';
       // هون بخلي يعمل Apply
    }else{
        echo'<div>Hello 2</div>';
       // header("Location:Login.php",true);
        die("");
    }  
}else{
    echo'<div>Hello 3</div>';
   // header("Location:Login.php",true);
    die("");

}
?>