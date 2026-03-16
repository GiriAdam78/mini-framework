<?php

$project = $argv[2] ?? null;

if (!$project) {
    echo "Please provide project name\n";
    exit;
}

mkdir($project);

copySkeleton($project);

echo "Project $project created successfully\n";

function copySkeleton($project)
{
    $skeleton = __DIR__ . '/../../skeleton';

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($skeleton)
    );

    foreach ($iterator as $file) {
        if ($file->isDir()) continue;

        $target = $project . '/' . $iterator->getSubPathName();

        if (!is_dir(dirname($target))) {
            mkdir(dirname($target), 0777, true);
        }

        copy($file, $target);
    }
}