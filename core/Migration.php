<?php 

namespace Core;

class Migration {
    public function run()
    {
        $path = __DIR__ . '/../database/migrations/*.php';

        $files = glob($path);

        if(!$files){
            echo "No migration files found\n";
            return;
        }

        foreach ($files as $file){
            echo "Loading: ". basename($file) . PHP_EOL;

            require_once $file;

            $classes = get_declared_classes();

            foreach ($classes as $class){
                
                if(method_exists($class, 'up')) {

                    echo "Running migration" . $class . PHP_EOL;

                    $migration = new $class();
                    $migration->up();
                }
            }
        }

    }
}