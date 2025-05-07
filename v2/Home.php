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
                <a href="Account/login.php" class="btn" style="margin-top:0% ;">Login</a>
            </section>
          </header>
            <!-- Header Section end-->
           <!--home section start-->
           <div class="home-container">
             <section class="home">
                <form  method="GET">
                  <h3>find your job</h3>
                  <p style="font-size: 1.8rem; color: #777;text-transform: capitalize;padding-left: 1rem;"> </p>
                  <input type="text" name="title" placeholder="job title " 
                   required maxlength="20" class="input">
                  <button type="submit" name="btn-search" class="btn">search</button>
                  
                </form>
             </section>
           </div>

           <!--home section end--> 

 <?php      
if(isset($_GET['btn-search'])){
    $SEARCH=$database->prepare(" SELECT * FROM jobs WHERE job_title LIKE :job_title ");
    $SEARCHTITLE="%".$_GET['title']."%";
    $SEARCH->bindParam("job_title", $SEARCHTITLE);
    $SEARCH->execute();
    echo'
    <h1 class="heading">Result</h1>
    <section class="jobs-container">
      <div class="box-container"> ';
    foreach($SEARCH AS $Result){          
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
                            <p class="salary"><span><?php echo $Result['salary']?>$ </span></p>
                            <p class="job-type"><?php echo $Result['job_type']?></span></p>
                         </div>
                         <p class="description">
                            <span><?php echo $Result['desciption']?></span></p>
                         <div class="flex-btn">
                         <form action="apply.php" method="POST">
                              <input type="hidden" name="job_id" value="<?php echo $Result['job_id']?>">
                            <button type="submit" name="Apply"  class="btn">Apply</button>
                             
                           </form>
                         </div>

                      </div> 
<?php }} ?>
</div> </section>
        
            <!--job section start-->
          
         <section class="jobs-container">

                <h1 class="heading">The jobs</h1>

                <div class="box-container"> 
                   <?php
                
                 $getItem =$database->prepare("SELECT * FROM jobs");
                 $getItem->execute();      
                         foreach($getItem AS $Result){   
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
                            <p class="salary"><span><?php echo $Result['salary']?>$ </span></p>
                            <p class="job-type"><?php echo $Result['job_type']?></span></p>
                         </div>
                         <p class="description">
                            <span><?php echo $Result['desciption']?></span></p>
                         <div class="flex-btn">
                           <form  method="POST">
                            
                              <a href="Account/apply.php?apply=<?php echo $Result['job_id']?>" class="btn">Apply</a>
                          
                             
                           </form>
                         </div>

                      </div><?php }; ?>

                     <div class="box">
                        <div class="company">
                           <img src="" alt="">
                           <div>
                              <h3>Microsoft</h3>
                              <p>2days ago</p>
                           </div>
                        </div>
                        <h3 class="job-titel">senior web developer</h3>
                        <p class="location">
                        <span>damascus,syria</span></p>
                        <div class="tags">
                           <p class="salary"><span>10k-25k </span></p>
                           <p class="job-type">part-time</span></p>
                        </div>
                        <p class="description">
                           <span>5 years experience using javaScript ,React ,Nods.js and MongoDB </span></p>
                        <div class="flex-btn">
                           <a href="" class="btn">Appley</a>
                           <button type="submit"></button>
                        </div>

                     </div>

                     <div class="box">
                        <div class="company">
                           <img src="" alt="">
                           <div>
                              <h3>Microsoft</h3>
                              <p>2days ago</p>
                           </div>
                        </div>
                        <h3 class="job-titel">senior web developer</h3>
                        <p class="location">
                        <span>damascus,syria</span></p>
                        <div class="tags">
                           <p class="salary"><span>10k-25k </span></p>
                           <p class="job-type">part-time</span></p>
                        </div>
                        <p class="description">
                           <span>5 years experience using javaScript ,React ,Nods.js and MongoDB </span></p>
                        <div class="flex-btn">
                           <a href="" class="btn">Appley</a>
                           <button type="submit"></button>
                        </div>

                     </div>
                </div>       
              </section> 

             <!--job section end-->



          <!--footer section start-->
          <footer class="footer">
            <section class="grid">
                <div class="box">
                    <h3>quick links </h3>
                    <a href="Home.html"><i></i>home</a>
                    <a href="About.html"><i></i>about</a>
                    <a href="Jobs.html"><i></i>jobs</a>
                </div>

                <div class="box">
                    <h3>extra links </h3>
                    
                    <a href="register.html"><i></i> register</a>
                    <a href="Login.html"><i></i> Login</a>
                    <a href="register.html"><i></i>account</a>
                </div>

                <div class="box">
                <h3>follow us</h3>
                <a href="#"><i></i> facebook</a>
                <a href="#"><i></i> instagram</a>
                <a href="#"><i></i>linkedin</a>
                </div>
            </section>
            

          </footer>
          <!--footer section end-->
       
         <!-- js File-->
          <script src="./dist/js/script.min.js"></script>
     </body>
     </html>