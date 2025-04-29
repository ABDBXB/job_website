<?php
include __DIR__ . '/header.php';
?>

<!--home section start-->
<div class="home-container">
    <section class="home">
        <form action="" method="post">
            <h3>find your job</h3>
            <p>job title</p>
            <input type="text" name="title" placeholder="keyword, job name"
                required maxlength="20" class="input">
            <input type="submit" value="search job" name="search" class="btn">

        </form>
    </section>
</div>
<!--home section end-->

<?php
// Database connection
$host = 'localhost';
$db = 'job_website';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch jobs with company info
$sql = "SELECT Jobs.*, Companies.name AS company_name 
        FROM Jobs 
        JOIN Companies ON Jobs.company_id = Companies.id 
        ORDER BY published_at DESC";
$result = $conn->query($sql);

?>

<!--job section start-->
<section class="jobs-container">
    <h1 class="heading">The jobs</h1>
    <div class="box-container">

        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): 

                ?>
                <div class="box">
                    <div class="company">
                        <img src="" alt="">
                        <div>
                            <h3><?= htmlspecialchars($row['company_name']) ?></h3>
                            <p><?= date("j M Y", strtotime($row['published_at'])) ?></p>
                        </div>
                    </div>
                    <h3 class="job-titel"><?= htmlspecialchars($row['title']) ?></h3>
                    <p class="location">
                        <span><?= htmlspecialchars($row['location']) ?></span>
                    </p>
                    <div class="tags">
                        <p class="salary"><span><?= number_format($row['salary']) ?> </span></p>
                        <p class="job-type"><?= strtolower($row['job_type']) ?></p>
                    </div>
                    <p class="description">
                        <span><?= htmlspecialchars($row['description']) ?></span>
                    </p>
                    <div class="flex-btn">
                        <a href="#" class="btn">Apply</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No jobs found.</p>
        <?php endif; ?>

    </div>
</section>

<?php
$conn->close();
?>


<!--job section end-->


<?php
include  __DIR__ . '/footer.php';
?>