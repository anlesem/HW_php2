<?php

namespace App\Repositories;

use App\Blog\Article\Post;
use App\Connection\ConnectorInterface;
use App\Connection\SqLiteConnector;
use App\Exceptions\PostNotFoundException;
use PDO;

class PostRepository implements PostRepositoryInterface {
  private PDO $connection;

  public function __construct(private  ? ConnectorInterface $connector = null) {
    $this->connector  = $connector ?? new SqLiteConnector();
    $this->connection = $this->connector->getConnection();
  }

  public function save(Post $post) : void {
    $statement = $this->connection->prepare(
      'INSERT INTO post (author_id, title, text)
      VALUES (:author_id, :title, :text)'
    );

    $statement->execute(
      [
        'author_id' => $post->getAuthorId(),
        'title'     => $post->getTitle(),
        'text'      => $post->getText(),
      ]
    );
  }

  public function get(int $id): Post {
    $statement = $this->connection->prepare(
      'SELECT * FROM post WHERE id = :id'
    );

    $statement->execute([
      'id' => $id,
    ]);

    $postObj = $statement->fetch(PDO::FETCH_OBJ);

    if (!$postObj) {
      throw new PostNotFoundException("post with id:$id not found");
    }

    $userRepository = new UserRepository();
    $user           = $userRepository->get($postObj->author_id);

    $post = new Post($user, $postObj->title, $postObj->text);

    $post
      ->setId($postObj->id);

    return $post;
  }
}