<?php

class Database
{
    // get database connection and return pdo object;
    public function getConn()
    {
        $db_host = "localhost";
        $db_name = "cms";
        $db_user = "noogai123";
        $db_password = "d(z.NNGVZskZh5P3";

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

        try {

            return new PDO($dsn, $db_user, $db_password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
