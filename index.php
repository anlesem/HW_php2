<?php

// use App\Blog\Article\Post;
// use App\Comment\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
// use App\User\Entities\User;

require_once __DIR__ . '/database/config.php';
require_once __DIR__ . '/vendor/autoload.php';

//! Урок 2
$userRepository = new UserRepository();

// $user1          = new User('Иван', 'Петров');
// $user2          = new User('Василий', 'Сидоров');
// $user3          = new User('Пётр', 'Кузнецов');

// $userRepository->save($user1);
// $userRepository->save($user2);
// $userRepository->save($user3);

$user11 = $userRepository->get(1);
$user22 = $userRepository->get(2);
$user33 = $userRepository->get(3);

//! Задание к уроку 2

$postRepository = new PostRepository();
// $post1 = new Post($user, 'Первый пост', 'Привет всем');
// $post2 = new Post($user, 'Второй пост', 'Всем добра');
// $post3 = new Post($user, 'Следующий пост', 'Всех благ');
// $post4 = new Post($user, 'Приветствие', 'Здравствуйте');

// $postRepository->save($post1);
// $postRepository->save($post2);
// $postRepository->save($post3);
// $postRepository->save($post4);

$post11 = $postRepository->get(1);
$post22 = $postRepository->get(2);
$post33 = $postRepository->get(3);
$post44 = $postRepository->get(4);

$commentRepository = new CommentRepository();
// $comment1 = new Comment($post22, $user11, 'Отличная новость');
// $comment2 = new Comment($post22, $user33, 'Согласен');
// $comment3 = new Comment($post44, $user22, 'Учту');

// $commentRepository->save($comment1);
// $commentRepository->save($comment2);
// $commentRepository->save($comment3);

$comment = $commentRepository->get(3);

echo "Пост <br> $post22 <br>";
echo "Комментарий <br> $comment <br>";

// var_dump($comment);
// die();