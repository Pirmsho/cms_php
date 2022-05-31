<?php

// establish connection to the server and return $conn variable
function getDB()
{

    $db_host = "localhost";
    $db_name = "cms";
    $db_user = "noogai123";
    $db_password = "d(z.NNGVZskZh5P3";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name); // connection to db variable

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
