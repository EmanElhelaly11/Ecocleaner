<?php

class Achievement {
    private $pdo; // set the database connection object as a private property of the class
    private $table = "achievements";
    public $id;

    // Constructor method to initialize the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

     
//----------- Refactoring || Code Smell - Uncommunicative Name ----------------

//   public function rAA() {
//     $query = 'SELECT ' . $this->table . '.*, posts.city, posts.image
//               FROM ' . $this->table . ' 
//               LEFT JOIN posts ON(' . $this->table . '.post_id = posts.id)
//               ORDER BY ' . $this->table . '.created_at DESC';
 
//     try {
//         $stmt = $this->pdo->prepare($query);
//         $stmt->execute();
//         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         return $results;
//     } catch(PDOException $e) {
//         echo $e->getMessage();
//         return false;
//     }
// }

    // Read all achievements posts
    public function readAllAchievements() {
        // Prepare the SQL statement to select all achievements
        $query = 'SELECT ' . $this->table . '.*, posts.city, posts.image
                  FROM ' . $this->table . ' 
                  LEFT JOIN posts ON(' . $this->table . '.post_id = posts.id)
                  ORDER BY ' . $this->table . '.created_at DESC';
     
        // Use a try-catch block to handle any exceptions that may occur during the query execution
        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);

            // Execute the prepared statement
            $stmt->execute();

            // Fetch the results as an associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Return the results
            return $results;
        } catch(PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }
    }




    // Add new achievement
    public function addAchievement($image_temp_name) {
        $image = $_FILES['image']['name'];
        $imgoldLocation = $_FILES['image']['tmp_name'];
    
        $r = rand();
        $t = time();
        $newloc = "../assets/img/$r$t$image";
        move_uploaded_file($imgoldLocation,$newloc);
        // Get the post ID from the URL parameter
        $post_id = isset($_GET['id']) ? $_GET['id'] : null;
    
        // Prepare the SQL statement to insert a new achievement record
        $query = "INSERT INTO " . $this->table . " (post_id, image_after) VALUES (:post_id, :image_after)";
    
        // Use a try-catch block to handle any exceptions that may occur during the query execution
        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);
    
            // Bind the values to the placeholders in the SQL statement
            $stmt->bindValue(':post_id', $post_id);
            $stmt->bindValue(':image_after', $newloc);
    
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Set the ID property of the achievement object to the ID of the newly inserted record
                $this->id = $this->pdo->lastInsertId();
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }
    }

}
