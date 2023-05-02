<?php
session_start();

// Include the database connection and Achievement class
include_once('../config/database.php');
include_once('../classes/Achievement.php');
include('../includes/header.php');
include('../includes/navbar.php');

// Get the post_id from the URL
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : null;

// Check if the form has been submitted
if (isset($_POST['add'])) {
    // Create a new Achievement object and set its properties
    $achievement = new Achievement($pdo);

    // Sanitize input
    $post_id = htmlspecialchars($post_id);

    // Attempt to create the achievement
    if ($achievement->addAchievement($_FILES['image']['name'], $_FILES['image']['tmp_name'], $_SESSION['user_id'], $post_id)) {
        // Redirect to the homepage or display a success message
        header('Location: achievements.php');
        exit;
    } else {
        // Display an error message
        echo 'An error occurred while creating the achievement.';
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
                    <h2 class="fw-bold mb-5">Add Achievement</h2>
                    <form method="post" enctype="multipart/form-data">
                        <!-- Image input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example5">Upload an image</label>
                            <input name="image" type="file" id="form3Example5" class="form-control" required />
                        </div>

                        <!-- Hidden input field to store post_id -->
                        <input type="hidden" name="post_id" value="<?= $post_id ?>" />

                        <!-- Submit button -->
                        <button name="add" type="submit" class="btn btn-success btn-block mb-4">
                            Add Achievement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HTML form for adding a new achievement -->

<?php
include('../includes/footer.php')
?>
