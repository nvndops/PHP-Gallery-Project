<?php

echo __FILE__ . "<br>";
echo __LINE__ . "<br>";
echo __DIR__ . "<br>";

if(file_exists(__DIR__)) {
    echo "YES <br>";
}

if(is_file(__DIR__)) {
    echo "YES <br>";
} else {
    echo "NO <br>";
}


if(is_dir(__DIR__)) {
    echo "YES <br>";
} else {
    echo "NO <br>";
}

if(is_dir(__DIR__)) {
    echo "YES <br>";
} else {
    echo "NO <br>";
}

echo file_exists(__FILE__) ? "YES" : "NO" ;




?>
