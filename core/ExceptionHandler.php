<?php

namespace Core;

use Core\Exceptions\NotFoundException;

class ExceptionHandler
{
    public static function handle($exception)
    {
        if($exception instanceof NotFoundException){
            http_response_code(404);

            require __DIR__ .'/../app/Views/errors/404.php';
        } else {
        
            http_response_code(500);

            $message = $exception->getMessage();
            $file = $exception->getFile();
            $line = $exception->getLine();
            $trace = $exception->getTraceAsString();
            $errorMessage = $message;
            // default type
            $errorType = 'application';

            // deteksi berdasarkan class exception
            if($exception instanceof \Core\Exceptions\DatabaseException){
             $errorType = 'database';
            }

            if($exception instanceof \Core\Exceptions\MigrationException){
             $errorType = 'migration';
            }

            require __DIR__.'/../app/Views/errors/500.php';

            exit;

        }
    }
}