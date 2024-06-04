<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;

class UserRepository {

    public function __construct(private Database $database) {

    }
 
    public function getAll(): array {
        $pdo = $this->database->getConnection();

        $stmt = $pdo->query('SELECT * FROM posts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(Array $data): string {

        $address = $data['address']['street'] . ', ' . $data['address']['suite'] . ', ' . $data['address']['city'] . ', ' . $data['address']['zipcode'];
        $company = $data['company']['name'] . ', ' . $data['company']['catchPhrase'] . ', ' . $data['company']['bs'];

        $sql = "INSERT INTO users(name, username, email, address, phone, website, company)
        VALUES(:name, :username, :email, :address, :phone, :website, :company)";

        $pdo = $this->database->getConnection();
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':website', $data['website'], PDO::PARAM_STR);
        $stmt->bindValue(':company', $company, PDO::PARAM_STR);

    
        $stmt->execute();

        return $pdo->lastInsertId();

    }
}