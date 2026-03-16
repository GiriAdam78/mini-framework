#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

$command = $argv[1] ?? null;

if ($command === 'new') {
    require __DIR__.'/../src/Console/NewCommand.php';
}