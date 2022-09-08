<?php

namespace App\Repositories;

use App\Comment\Comment;
use App\Connection\ConnectorInterface;
use App\Connection\SqLiteConnector;
use App\Exceptions\CommentNotFoundException;
use PDO;

class CommentRepository implements CommentRepositoryInterface {
  private PDO $connection;

  public function __construct(private  ? ConnectorInterface $connector = null) {
    $this->connector  = $connector ?? new SqLiteConnector();
    $this->connection = $this->connector->getConnection();
  }

  public function save(Comment $comment) : void {
    $statement = $this->connection->prepare(
      'INSERT INTO comment (post_id, author_id, text)
      VALUES (:post_id, :author_id, :text)'
    );

    $statement->execute(
      [
        'post_id'   => $comment->getPostId(),
        'author_id' => $comment->getAuthorId(),
        'text'      => $comment->getText(),
      ]
    );
  }

  public function get(int $id): Comment {
    $statement = $this->connection->prepare(
      'SELECT * FROM comment WHERE id = :id'
    );

    $statement->execute([
      'id' => $id,
    ]);

    $commentObj = $statement->fetch(PDO::FETCH_OBJ);

    if (!$commentObj) {
      throw new CommentNotFoundException("Comment with id:$id not found");
    }

    $postRepository = new PostRepository();
    $post           = $postRepository->get($commentObj->post_id);
    $userRepository = new UserRepository();
    $user           = $userRepository->get($commentObj->author_id);

    $comment = new Comment($post, $user, $commentObj->text);

    $comment
      ->setId($commentObj->id);

    return $comment;
  }
}