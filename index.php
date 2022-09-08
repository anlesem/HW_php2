<?php

use App\Repositories\UserRepository;

require_once __DIR__ . '/database/config.php';
require_once __DIR__ . '/vendor/autoload.php';

$userRepository = new UserRepository();
// $user1          = new User('Иван', 'Петров');
// $user2          = new User('Василий', 'Сидоров');
// $user3          = new User('Пётр', 'Кузнецов');

// $userRepository->save($user1);
// $userRepository->save($user2);
// $userRepository->save($user3);

$user = $userRepository->get(3);
var_dump($user);
die();