<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;

class PostRepository {

    public function __construct(private Database $database) {

    }
 
    public function getAll(): array {
        $pdo = $this->database->getConnection();

        $stmt = $pdo->query('SELECT posts.id, posts.user_id, posts.title, posts.body, users.username
        FROM posts
        INNER JOIN users ON posts.user_id = users.id');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function create(Array $data): string {

        $sql = "INSERT INTO posts(user_id, title, body)
        VALUES(:user_id, :title, :body)";

        $pdo = $this->database->getConnection();
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':user_id', $data['userId'], PDO::PARAM_INT);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':body', $data['body'], PDO::PARAM_STR);
    
        $stmt->execute();

        return $pdo->lastInsertId();

    }

    public function delete(int $postId): bool
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $postId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}