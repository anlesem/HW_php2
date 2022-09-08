<?php

namespace App\Comment;

use App\Blog\Article\Post;
use App\Traits\Id;
use App\User\Entities\User;

class Comment {
  use Id;

  public function __construct(
    private Post $post,
    private User $user,
    private string $text
  ) {
  }

  public function __toString() {
    return $this->user . ' прокомментировал: ' . $this->text . ' пост  ' . $this->post->getTitle();
  }

  public function getPostId(): int {
    return $this->post->getId();
  }

  public function getAuthorId(): int {
    return $this->user->getId();
  }

  public function getText(): string {
    return $this->text;
  }
}