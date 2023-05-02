<?php
session_start();

// Include the database connection and Post class
include_once('../config/database.php');
include_once('../classes/Post.php');
include('../includes/header.php');
include('../includes/navbar.php');


// Create a new Post object and set its properties
if (isset($_GET['id'])) {
    $postobj1 = new Post($pdo);

     if ($postobj1->readOne($_GET['id'])) {
        $post = $postobj1->readOne($_GET['id']);
        $city =$post['city'];
        $image =$post['image'];
        $link =$post['link'];
        $content =$post['content'];
    }
    }

// Check if the form has been submitted
if (isset($_POST['edit'])) {
    $postobj2 = new Post($pdo);

// Attempt to create the post
if ($postobj2->update($_POST['city'], $_POST['image'], $_POST['link'],$_POST['content'], $_GET['id'])) {
// Redirect to the homepage or display a success message
header('Location: home.php');
exit;
} else {
// Display an error message
    echo 'An error occurred while creating the post.';
    }
}
   if ($_SESSION['user_id'] != $post['author_id']) {
    header('Location: ../index.php');
}

?>

<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('../assets/img/test.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Edit Post</h2>
                    <form method="post" enctype="multipart/form-data">


                       <div class="form-outline mb-4">
                <label class="form-label" for="citySelect">City</label>
     <select class="form-control" id="citySelect" name="city">
        <option value="" selected disabled>Select City</option>
        <option <?php if($post['city'] == "Alexandria"){echo "selected";} ?> value="Alexandria">Alexandria</option>
        <option <?php if($post['city'] == "Aswan"){echo "selected";} ?> value="Aswan">Aswan</option>
        <option <?php if($post['city'] == "Asyut"){echo "selected";} ?> value="Asyut">Asyut</option>
        <option <?php if($post['city'] == "Beheira"){echo "selected";} ?> value="Beheira">Beheira</option>
        <option <?php if($post['city'] == "Beni Suef"){echo "selected";} ?> value="Beni Suef">Beni Suef</option>
        <option <?php if($post['city'] == "Cairo"){echo "selected";} ?> value="Cairo">Cairo</option>
        <option <?php if($post['city'] == "Dakahlia"){echo "selected";} ?> value="Dakahlia">Dakahlia</option>
        <option <?php if($post['city'] == "Damietta"){echo "selected";} ?> value="Damietta">Damietta</option>
        <option <?php if($post['city'] == "Faiyum"){echo "selected";} ?> value="Faiyum">Faiyum</option>
        <option <?php if($post['city'] == "Gharbia"){echo "selected";} ?> value="Gharbia">Gharbia</option>
        <option <?php if($post['city'] == "Giza"){echo "selected";} ?> value="Giza">Giza</option>
        <option <?php if($post['city'] == "Ismailia"){echo "selected";} ?> value="Ismailia">Ismailia</option>
        <option <?php if($post['city'] == "Kafr El Sheikh"){echo "selected";} ?> value="Kafr El Sheikh">Kafr El Sheikh</option>
        <option <?php if($post['city'] == "Luxor"){echo "selected";} ?> value="Luxor">Luxor</option>
        <option <?php if($post['city'] == "Matrouh"){echo "selected";} ?> value="Matrouh">Matrouh</option>
        <option <?php if($post['city'] == "Minya"){echo "selected";} ?> value="Minya">Minya</option>
        <option <?php if($post['city'] == "Monufia"){echo "selected";} ?> value="Monufia">Monufia</option>
        <option <?php if($post['city'] == "New Valley"){echo "selected";} ?> value="New Valley">New Valley</option>
        <option <?php if($post['city'] == "North Sinai"){echo "selected";} ?> value="North Sinai">North Sinai</option>
        <option <?php if($post['city'] == "Port Said"){echo "selected";} ?> value="Port Said">Port Said</option>
        <option <?php if($post['city'] == "Qalyubia"){echo "selected";} ?> value="Qalyubia">Qalyubia</option>
        <option <?php if($post['city'] == "Qena"){echo "selected";} ?> value="Qena">Qena</option>
        <option <?php if($post['city'] == "Red Sea"){echo "selected";} ?> value="Red Sea">Red Sea</option>
        <option <?php if($post['city'] == "Sharqia"){echo "selected";} ?> value="Sharqia">Sharqia</option>
        <option <?php if($post['city'] == "Sohag"){echo "selected";} ?> value="Sohag">Sohag</option>
        <option <?php if($post['city'] == "South Sinai"){echo "selected";} ?> value="South Sinai">South Sinai</option>
        <option <?php if($post['city'] == "Suez"){echo "selected";} ?> value="Suez">Suez</option>
        </select>
   </div>



              <div class="form-outline mb-4">
               <p>Current Image <img src="<?= $post['image']?>" width="200"></p>
               <label class="form-label" for="form3Example5">Upload an image</label>
               <input name="image"  type="file" id="form3Example5" class="form-control" />
            </div>
                 
               <div class="form-outline mb-4">
               <label class="form-label" for="form3Example6">Google Maps link</label>
               <input name="link" value="<?= $post['link'] ?>" type="text" id="form3Example6" class="form-control" />
               </div>

  
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Description</label>
                            <textarea name="content"  id="form3Example4" class="form-control"><?= $post['content'] ?></textarea>
                        </div>

                        <button name="edit" type="submit" class="btn btn-success btn-block mb-4">
                            Edit Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HTML form for updating a new post -->

<?php
include('../includes/footer.php')
?>