<?php

session_start();
ob_start();

require __DIR__ .'/../vendor/autoload.php';
require __DIR__ .'/../core/helpers.php';
require __DIR__ .'/../bootstrap/app.php';
require_once __DIR__ .'/../core/helpers.php';

use Core\CSRF;
use Core\ExceptionHandler;
use Core\DatabaseChecker;
use Core\Request;

use Dotenv\Dotenv;

CSRF::validate();

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

$request = new Request();


set_exception_handler([ExceptionHandler::class, 'handle']);
set_error_handler(function ($level, $message, $file, $line) {

    throw new \ErrorException($message, 0, $level, $file, $line);

});

register_shutdown_function(function(){

    $error = error_get_last();

    if($error){

        ob_clean();

        $exception = new ErrorException(
            $error['message'],
            0,
            $error['type'],
            $error['file'],
            $error['line']
        );

        \Core\ExceptionHandler::handle($exception);
    }

});
DatabaseChecker::check();


$router->run($request);