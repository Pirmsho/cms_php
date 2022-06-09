<?php

require 'includes/database.php';
require 'includes/article-func.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

if (!isLoggedIn()) {
    die("unauthorised");
}

$errors = [];
$title = "";
$content = "";
$published_at = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {



        $conn = getDB();

        $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?,?,?)"; // placeholders for sql statement


        $statement = mysqli_prepare($conn, $sql); // prepare the sql statement

        if ($statement === false) {
            echo mysqli_error($conn);
        } else {

            if ($_POST["published_at"] == "") {
                $_POST["published_at"] = null;
            }


            mysqli_stmt_bind_param($statement, "sss", $_POST["title"], $_POST["content"], $_POST["published_at"]); // bind placeholders to actual values

            if (mysqli_stmt_execute($statement)) {

                $id = mysqli_insert_id($conn);

                redirect("/article.php?id=$id");
            } else {
                mysqli_stmt_error($statement);
            }
        }
    }
}
?>

<?php require 'includes/header.php'  ?>

<h2>New Article</h2>

<?php require 'includes/article-form.php'  ?>

<?php require 'includes/footer.php'  ?>