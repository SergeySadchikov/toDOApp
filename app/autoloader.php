<?php

spl_autoload_register('load_class');
function load_class($class)
{
    $pathToFile = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    if (file_exists($pathToFile)) {
        require_once "$pathToFile";
    }
}