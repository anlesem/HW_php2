<?php

function databaseConfig(): array
{
  return [
    'sqlite' =>
    [
      'DATABASE_URL' => "sqlite:" . __DIR__ . '/blog.db',
    ],

    'mysql'  => [
      'driver'   => 'mysql',
      'user'     => 'root',
      'password' => '******',
      'database' => 'test',
    ],
  ];
}