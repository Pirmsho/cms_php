<?php

class Category
{
    // fetch all categories function
    public static function getAllCategories($conn)
    {
        $sql = "SELECT * 
                FROM category 
                ORDER BY name;";

        $results = $conn->query($sql); // results from given query 

        return  $results->fetchAll(PDO::FETCH_ASSOC); // fetch all rows with given query and assign it 
    }
}
