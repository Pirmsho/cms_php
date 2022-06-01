<?php

require 'includes/database.php';
require 'includes/article-func.php';
require 'includes/url.php';


$conn = getDB();

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = getArticle($conn, $_GET['id']);

    if ($article) {
        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {

        die('article not found');
    }
} else {

    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {

        $sql = "UPDATE article 
                SET title = ?,
                content = ?,
                published_at = ?
                WHERE id = ?"; // placeholders for sql statement


        $statement = mysqli_prepare($conn, $sql); // prepare the sql statement

        if ($statement === false) {
            echo mysqli_error($conn);
        } else {

            if ($_POST["published_at"] == "") {
                $_POST["published_at"] = null;
            }


            mysqli_stmt_bind_param($statement, "sssi", $title, $content, $published_at, $id); // bind placeholders to actual values

            if (mysqli_stmt_execute($statement)) {

                redirect("/article.php?id=$id");
            } else {
                mysqli_stmt_error($statement);
            }
        }
    }
}
?>

<?php require 'includes/header.php'  ?>

<h2>Edit Article</h2>

<?php require 'includes/article-form.php'  ?>

<?php require 'includes/footer.php'  ?>