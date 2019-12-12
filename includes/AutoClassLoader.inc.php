<?php
// This file allows class file paths to automatically be found and included into the files which contain a class method found in this project.

spl_autoload_register('myAutoClassLoader');

function myAutoClassLoader($fileName){
    $path = "../classes/";
    $extension = ".class.php";
    $fullPath = $path . $fileName . $extension;
    include_once $fullPath;
}// end myAutoClassLoader
?>