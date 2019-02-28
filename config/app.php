<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 28.2.2019
 * Time: 21:10
 */

use src\Operation;

function autoload($path, $first = true)
{
    foreach (scandir($path) as $folder) {
        if ($folder != "." && $folder != ".idea" && $folder != ".git" && $folder != ".." && is_dir($folder)) {
            foreach (scandir($folder, 0) as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) == "php") {
                    require_once $folder . "/" . $file;
                } elseif (is_dir($folder . "/" . $file) && $file != "." && $file != "..") {
                    autoload($path . $folder . "/" . $file, false);
                }
            }
        } elseif (pathinfo($folder, PATHINFO_EXTENSION) == "php" && $first === false) {
            require_once $path . "/" . $folder;
        }
    }
    return true;
}

autoload(PATH);
//try {
//    autoload(PATH);
//} catch (Exception $e) {
//    echo "Error: " . $e->getMessage();
//}
$islem = new Operation();
