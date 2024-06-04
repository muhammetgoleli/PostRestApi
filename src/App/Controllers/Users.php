<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\UserRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class Users {

    public function __construct(private UserRepository $userRepository)
    {
        
    }

    public function create(Request $request, Response $response): Response {

        $users = file_get_contents('https://jsonplaceholder.typicode.com/users');
        
        $users = json_decode($users, true);
                
        $userRepository = $this->userRepository;
        
        foreach ($users as $user) {
            if(!$this->userRepository->exists($user['email'])) {
                $userRepository->create($user);
            }
        }

        $body = json_encode([
            'message' => 'Users Created'
        ]);

        $body = json_encode(['message' => 'Users Created']);

        $response->getBody()->write($body);

        return $response->withStatus(201);

    }
}
