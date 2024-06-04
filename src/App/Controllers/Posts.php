<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\PostRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class Posts {

    public function __construct(private PostRepository $postRepository)
    {
       
    }

    public function index(Request $request, Response $response): Response
    {
        $data = $this->postRepository->getAll();

        $jsonData = json_encode($data);

        $response->getBody()->write($jsonData);

        return $response->withStatus(200);
    }

    public function create(Request $request, Response $response): Response {

        $posts = file_get_contents('https://jsonplaceholder.typicode.com/posts');
        
        $posts = json_decode($posts, true);
                
        $postRepository = $this->postRepository;
        
        foreach ($posts as $post) {
            $id = $postRepository->create($post);
        }

        $body = json_encode([
            'id' => $id,
            'message' => 'Posts Created'
        ]);

        $response->getBody()->write($body);

        return $response->withStatus(201);

    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $postId = (int)$args['id'];
        $deleted = $this->postRepository->delete($postId);

        if ($deleted) {
            $response->getBody()->write(json_encode(['message' => 'Post deleted']));
            return $response->withStatus(200);
        } else {
            $response->getBody()->write(json_encode(['message' => 'Post not found']));
            return $response->withStatus(404);
        }
    }
}
