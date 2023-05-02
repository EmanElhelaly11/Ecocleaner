<?php

Class Post {
  private $pdo; // set the database connection object as a private property of the class
  private $table = "posts";
  public $id;

   // Constructor method to initialize the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

    // Create a new post
    public function createPost($city, $image, $link, $content, $author_id) {
        // Get the uploaded file details
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
    
        // Generate a unique file name and move the uploaded file to the new location
        $random_int = rand();
        $timestamp = time();
        $image_path = "../assets/img/{$random_int}{$timestamp}{$image_name}";
        move_uploaded_file($image_tmp, $image_path);
    
        // Prepare the SQL statement
        $query = "INSERT INTO {$this->table} (city, image, link, content, author_id) VALUES (:city, :image, :link, :content, :author_id)";
        
        // Execute the prepared statement
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                ':city' => $city,
                ':image' => $image_path,
                ':link' => $link,
                ':content' => $content,
                ':author_id' => $author_id,
            ]);
            return true;
        } catch(PDOException $exception) {
            // Handle any exceptions that may occur during the query execution
            echo $exception->getMessage();
            return false;
        }
    }
    


//----------- Refactoring || Code Smell - Long Method ----------------

//  function readPosts($id = null) {
//         if ($id) {
//             $query = "SELECT p.city,p.image,p.link, p.content , p.author_id , p.created_at, u.username as author_name 
//             FROM " . $this->table . " p INNER JOIN users u
//              ON p.author_id = u.id WHERE p.id = ? LIMIT 0,1";         
//             try {
//                 $stmt = $this->pdo->prepare($query);
    
//                 $stmt->bindParam(1, $id);
    
//                 $stmt->execute();
                
//                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
//                 return $row;
                
//             } catch (PDOException $e) {
//                 echo $e->getMessage();
//                 return false;
//             }
//         } else {
//             $query = 'SELECT ' . $this->table . '.* , users.username FROM ' . $this->table . ' LEFT JOIN users
//             ON(' . $this->table . '.author_id = users.id
//              )ORDER BY ' . $this->table . '.created_at DESC' ;
        
//             try {

//                 $stmt = $this->pdo->prepare($query);
    
//                 $stmt->execute();
    
//                 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//                 return $results;
//             } catch(PDOException $e) {

//                 echo $e->getMessage();
//                 return false;

//             }
//         }
// }
    

    // Read all blog posts
    public function readAllPosts() {
       // Prepare the SQL statement to select all posts
         $query = 'SELECT ' . $this->table . '.* , users.username FROM ' . $this->table . ' LEFT JOIN users
        ON(' . $this->table . '.author_id = users.id
         )ORDER BY ' . $this->table . '.created_at DESC' ;
    

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

    // Read a single post
    function readOne($id)
    {

        // SQL query to select a single post from the database
        $query = "SELECT p.city,p.image,p.link, p.content , p.author_id , p.created_at, u.username as author_name 
        FROM " . $this->table . " p INNER JOIN users u
         ON p.author_id = u.id WHERE p.id = ? LIMIT 0,1";         
        // Use a try-catch block to handle any exceptions that may occur during the query execution
        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);

            // Bind the id parameter
            $stmt->bindParam(1, $id);

            // Execute the prepared statement
            $stmt->execute();
            
            // Get the row data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            
            // Return the results
            return $row;
            
        } catch (PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }
        $this->id = $id; // set the id property
        return $post;

    }


  // Update an existing post
function update($city, $image, $link, $content, $id)
 {
    $imgoldLocation = '';
    $newloc = '';

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $imgoldLocation = $_FILES['image']['tmp_name'];
        $r = rand();
        $t = time();
        $newloc = "../assets/img/$r$t$image";
        move_uploaded_file($imgoldLocation, $newloc);
    } else {
        // Get the old image path from the database
        $query = "SELECT image FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $old_image = $stmt->fetchColumn();

        // Set the old image path as the new path
        $newloc = $old_image;
    }

    // SQL query to update an existing post in the database
    $query = "UPDATE " . $this->table . " SET city=:city, image=:image, link=:link, content=:content WHERE id=:id";

    // Prepare the query for execution
    $stmt = $this->pdo->prepare($query);

    // Clean data
    $city = htmlspecialchars(strip_tags($city));
    $content = htmlspecialchars(strip_tags($content));
    $link = htmlspecialchars(strip_tags($link));
    $id = htmlspecialchars(strip_tags($id));

    // Bind the data
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":image", $newloc);
    $stmt->bindParam(":link", $link);
    $stmt->bindParam(":id", $id);

    // Execute the query
    if ($stmt->execute()) {
        return true;
    }

    return false;
}
    

  // Delete an existing post
   function delete()
    {
        // SQL query to delete an existing post from the database
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";


        // Use a try-catch block to handle any exceptions that may occur during the query execution
        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind the data
            $stmt->bindParam(":id", $this->id);

            // Execute the prepared statement
            $stmt->execute();


            // Return the results
            return true;
        } catch (PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }
    }

}


?>