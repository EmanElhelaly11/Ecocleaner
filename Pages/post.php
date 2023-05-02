<?php
session_start();
include_once ('../config/database.php');
include_once ('../Classes/Post.php');
include_once ('../classes/Achievement.php');
include('../includes/header.php');
include('../includes/navbar.php');

$postobj = new POST($pdo);


if (isset($_GET['id'])) {
    if ($postobj->readOne($_GET['id'])) {
        $post = $postobj->readOne($_GET['id']);
    }
}

if (isset($_POST['delete_post'])) {
    $postobj->id = $_GET['id'];
    if ($postobj->delete()) {
        header('Location: home.php');
    }
}
?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('../assets/img/login.jpg')">
<div class="container position-relative px-4 px-lg-5">
  <div class="site-heading" style="font-size: .5rem;">
    <h1> Clean up for a cleaner future! </h1>
  </div>
        <?php if (isset($_SESSION['user_id'])) {?>
            <?php if($_SESSION['user_id']==1) {?>
                <a href=<?= "add_achievement.php?id=" . $_GET['id'] ?> class="btn btn-sm" type="submit"><i
                    class="fas fa-star text-white fs-3"></i></a>
            <?php }?>  
            <?php if($_SESSION['user_id']==$post['author_id']) {?>
            <a href=<?= "edit_post.php?id=" . $_GET['id'] ?> class="btn btn-sm" type="submit"><i
                    class="fas fa-edit text-white fs-3"></i></a>
            <form method="post" style="display: inline-block;">
                <button class="btn btn-sm" type="submit" name="delete_post"><i class="fas fa-trash text-white fs-3"></i></button>
            </form>
            <?php }?>
        <?php } ?>
    </div>
</header>



<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="post-preview">
                      
                <h2>
                    <?php
                    if (isset($post['city'])) :
                        echo $post['city']."<br>"."<br>";
                    endif
                    ?>
                </h2> 
                      <?php
                      if ($post) :
                        echo $post['content']."<br>"."<br>";
                      endif; 
                      ?>
                    <?php
                    if ($post) :?>
                     <a href=<?= $post['link']?>> Google Maps link</a>
                    <?php
                     echo "<br>"."<br>";
                    endif;
                    ?>
                <p class="post-meta">
                    Posted by
                    <a href="#!">
                        <?php
                        if (isset($post['author_name'])) :
                            echo $post['author_name']." ";
                        endif
                        ?>
                    </a>
                    <?php
                    if ($post) :
                        echo " " . $post['created_at'];
                        endif
                    ?>
                </p>
            </div>

                    <?php
                    if ($post) :?>
                        <img src="<?= $post['image'] ?>"  width="100%" height="50%" class="card-img-top" alt="Post image">
                    <?php endif;
                    ?>
                    
                </p>
            </div>
        </div>
    </div>
</article>


<?php
include('../includes/footer.php');
?>