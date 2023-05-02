<?php

//----------Data Access Object (DAO) Design Pattern-------------

class Post {
    private $dao;

    public function __construct(PostDAO $dao) {
        $this->dao = $dao;
    }

    public function createPost($city, $image, $link, $content, $author_id) {
        // Use the DAO to create the post
        return $this->dao->create($city, $image, $link, $content, $author_id);
    }
}



class PostDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create($city, $image, $link, $content, $author_id) {
        // Prepare the SQL statement with placeholders for the values to be inserted
        $query = "INSERT INTO posts (city, image, link, content, author_id) VALUES (:city, :image, :link, :content, :author_id)";

        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);

            // Bind the values to the placeholders in the prepared statement
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author_id', $author_id);

            // Execute the prepared statement
            $stmt->execute();

            // Return the ID of the newly created post
            return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }
    }
}
