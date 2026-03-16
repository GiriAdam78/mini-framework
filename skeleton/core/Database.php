<?php

namespace Core;

use PDO;

class Database
{
    public function connect()
    {

        $driver = $_ENV['DB_CONNECTION'] ?? 'mysql';

        switch ($driver) {

            case 'mysql':

                $dsn = sprintf(
                    "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
                    $_ENV['DB_HOST'],
                    $_ENV['DB_PORT'],
                    $_ENV['DB_DATABASE']
                );

                break;

            case 'pgsql':

                $dsn = sprintf(
                    "pgsql:host=%s;port=%s;dbname=%s",
                    $_ENV['DB_HOST'],
                    $_ENV['DB_PORT'],
                    $_ENV['DB_DATABASE']
                );

                break;

            case 'sqlite':

                $dsn = "sqlite:" . $_ENV['DB_DATABASE'];

                break;

            default:
                throw new \Exception("Unsupported database driver: ".$driver);

        }

        return new PDO(
            $dsn,
            $_ENV['DB_USERNAME'] ?? null,
            $_ENV['DB_PASSWORD'] ?? null,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}