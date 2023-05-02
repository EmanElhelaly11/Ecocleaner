<?php
include_once ('../config/database.php');
include_once ('../classes/Achievement.php');
include_once ('../classes/Achievements.php');
include('../includes/header.php');

session_start();
include('../includes/navbar.php');

$achievement = new Achievement($pdo);
$achievements = $achievement->readAllAchievements();

?>

<header class="masthead" style="background-image: url('../assets/img/ach1.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Achievements</h1>
                    <span class="subheading">A cleaner community starts with you.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container px-4 px-lg-5">
    <h2 style="color: green;">Before VS After</h2><br>
    <div class="circle"><?php echo ($achievements !== null) ? count($achievements) : 0; ?></div>

    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <?php foreach ($achievements as $ach) { ?>
                <div class="post-preview">
                    <a href=<?="post.php?id=". $ach['post_id'] ?>>
                        <center><h2 class="post-title"><?php echo $ach['city'] ?></h2></center>
                        <img src="<?= $ach['image'] ?>" width="500" height="500" class="card-img-top" alt="Post image">
                    </a>
                    <img src="<?= $ach['image_after'] ?>" width="500" height="500" class="card-img-top" alt="Post image">

                    <p class="post-meta">
                        Created at
                        <?php echo $ach['created_at']; ?>
                    </p>
                </div>
                <hr class="my-4" />
            <?php } ?>
        </div>
    </div>
</div>

<?php
include('../includes/footer.php')
?>
