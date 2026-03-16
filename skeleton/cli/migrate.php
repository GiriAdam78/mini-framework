<?php 

require __DIR__ . '../vendor/autoload.php';

use Core\Migration;

$migration = new Migration();
$migration->run();