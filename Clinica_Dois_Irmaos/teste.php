<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nomeDaClinica = "Albert Einstein";

$source = getcwd() . "/template/";
$dest   = getcwd() . "/$nomeDaClinica/"; 

$dest   = str_replace("/SistemaAdmin", "", $dest);
$source = str_replace("/SistemaAdmin", "", $source);

echo "source: $source <br>";
echo "dest: $dest <br>";
/*
if(xcopy($source, $dest))
    echo "Feito com sucesso<br>";
else
    echo "Deu alguma coisa errada<br>";


function xcopy($source, $dest, $permissions = 0755) {
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, $permissions);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        xcopy("$source/$entry", "$dest/$entry", $permissions);
    }

    // Clean up
    $dir->close();
    return true;
    
}
*/
?>