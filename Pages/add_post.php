<?php
session_start();

// Include the database connection and Post class
include_once('../config/database.php');
include_once('../classes/Post.php');
include('../includes/header.php');
include('../includes/navbar.php');


// Check if the form has been submitted
if (isset($_POST['add'])) {
    // Create a new Post object and set its properties
    $post = new Post($pdo);

    // Attempt to create the post
    if ($post->createPost($_POST['city'], $_POST['image'], $_POST['link'], $_POST['content'], $_SESSION['user_id'])) {
        // Redirect to the homepage or display a success message
        header('Location: home.php');
        exit;
    } else {
        // Display an error message
        echo ' An error occurred while creating the post.';
    }
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
                    <h2 class="fw-bold mb-5">Add Unclean Place</h2>
                    <form method="post" enctype="multipart/form-data">
                 <!-- City input -->
                 <div class="form-outline mb-4">
                <label class="form-label" for="citySelect">City</label>
     <select class="form-control" id="citySelect" name="city" required>
        <option value="" selected disabled>Select City</option>
        <option value="Alexandria">Alexandria</option>
        <option value="Aswan">Aswan</option>
        <option value="Asyut">Asyut</option>
        <option value="Beheira">Beheira</option>
        <option value="Beni Suef">Beni Suef</option>
        <option value="Cairo">Cairo</option>
        <option value="Dakahlia">Dakahlia</option>
        <option value="Damietta">Damietta</option>
        <option value="Faiyum">Faiyum</option>
        <option value="Gharbia">Gharbia</option>
        <option value="Giza">Giza</option>
        <option value="Ismailia">Ismailia</option>
        <option value="Kafr El Sheikh">Kafr El Sheikh</option>
        <option value="Luxor">Luxor</option>
        <option value="Matrouh">Matrouh</option>
        <option value="Minya">Minya</option>
        <option value="Monufia">Monufia</option>
        <option value="New Valley">New Valley</option>
        <option value="North Sinai">North Sinai</option>
        <option value="Port Said">Port Said</option>
        <option value="Qalyubia">Qalyubia</option>
        <option value="Qena">Qena</option>
        <option value="Red Sea">Red Sea</option>
        <option value="Sharqia">Sharqia</option>
        <option value="Sohag">Sohag</option>
        <option value="South Sinai">South Sinai</option>
        <option value="Suez">Suez</option>
        </select>
   </div>


                <!-- Image input -->
               <div class="form-outline mb-4">
               <label class="form-label" for="form3Example5">Upload an image</label>
               <input name="image" type="file" id="form3Example5" class="form-control" required />
               </div>

               <!-- Google Maps link input -->
               <div class="form-outline mb-4">
               <label class="form-label" for="form3Example6">Google Maps link</label>
               <input name="link" type="text" id="form3Example6" class="form-control" required />
               </div>

               <!-- Content input -->
               <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Description</label>
                <textarea name="content"  id="form3Example4" class="form-control" required></textarea>
               </div>

              <!-- Submit button -->
              <button name="add" type="submit" class="btn btn-success btn-block mb-4">
              Add Post
              </button>
               </form>

                
            </div>
        </div>
    </div>
</section>
<!-- HTML form for adding a new post -->

<?php
include('../includes/footer.php')
?>