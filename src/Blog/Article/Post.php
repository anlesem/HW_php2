<?php

namespace App\Blog\Article;

use App\Traits\Id;
use App\User\Entities\User;

class Post {
  use Id;

  public function __construct(
    private User $user,
    private string $title,
    private string $text
  ) {
  }

  public function __toString() {
    return $this->user . ' пишет: ' . $this->text . ' с заголовком: ' . $this->title;
  }

  public function getAuthorId(): int {
    return $this->user->getId();
  }

  public function getTitle(): string {
    return $this->title;
  }

  public function getText(): string {
    return $this->text;
  }
}