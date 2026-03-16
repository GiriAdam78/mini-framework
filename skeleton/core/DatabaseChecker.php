<?php

namespace Core;

class DatabaseChecker
{
    public static function check()
    {

        try {

            (new Database())->connect();

        } catch (\PDOException $e) {

            // lempar error asli PDO
            throw $e;

        }

    }
}