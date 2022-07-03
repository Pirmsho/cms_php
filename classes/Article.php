<?php

class Article
{
    // article properties
    public $id;
    public $title;
    public $content;
    public $published_at;
    public $image_file;
    public $errors = [];

    // fetch all articles function
    public static function getAllArticles($conn)
    {
        $sql = "SELECT * FROM article ORDER BY id;";

        $results = $conn->query($sql); // results from given query 

        return  $results->fetchAll(PDO::FETCH_ASSOC); // fetch all rows with given query and assign it to 
    }

    public static function getPage($conn, $limit, $offset)
    {
        $sql = "SELECT *
                FROM article
                ORDER BY id
                LIMIT :limit
                OFFSET :offset";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // fetch single article function
    public static function getSingleArticle($conn, $id, $columns = '*')
    {
        $sql = "SELECT $columns
            FROM article
            WHERE id = :id";

        $stmt = $conn->prepare($sql);


        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }


    // update single article function
    public function updateArticle($conn)
    {
        if ($this->validateArticle()) {


            $sql = "UPDATE article 
                SET title = :title,
                content = :content,
                published_at = :published_at
                WHERE id = :id"; // placeholders for sql statement


            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            return $stmt->execute();
        } else {
            return false;
        }
    }


    // validate article function
    protected function validateArticle()
    {

        if ($this->title == "") {
            $this->errors[] = "Title is required!";
        }

        if ($this->content == "") {
            $this->errors[] = "Content is required!";
        }

        if ($this->published_at != "") {
            $date_time = date_create_from_format('Y-m-d H:i:s', $this->published_at);

            if ($date_time === false) {
                $this->errors[] = "Invalid date and time";
            } else {
                $date_errors = date_get_last_errors();

                if ($date_errors['warning_count'] > 0) {
                    $this->errors[] = "Invalid date";
                }
            }
        }
        return empty($this->errors);
    }

    // delete single article function
    public function deleteArticle($conn)
    {
        $sql = "DELETE FROM article
                WHERE id = :id"; // placeholders for sql statement


        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);


        return $stmt->execute();
    }

    public function createNewArticle($conn)
    {

        if ($this->validateArticle()) {


            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES (:title, :content, :published_at)"; // placeholders for sql statement


            $stmt = $conn->prepare($sql);


            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            } else {
                return false;
            }
        }
    }

    // update the image file
    public function setImageFile($conn, $filename)
    {
        $sql = 'UPDATE article
                SET image_file = :image_file
                WHERE id = :id';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':image_file', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        return $stmt->execute();
    }

    // function to count number of articles
    public static function getTotal($conn)
    {
        return $conn->query('SELECT COUNT(*) FROM article')->fetchColumn();
    }
}
