<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getSingleArticle($conn, $_GET['id']);

    if (!$article) {

        die('article not found');
    }
} else {

    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];



    if ($article->updateArticle($conn)) {
        Url::redirect("/article.php?id={$article->id}");
    }
}
?>

<?php require 'includes/header.php'  ?>

<h2>Edit Article</h2>

<?php require 'includes/article-form.php'  ?>

<?php require 'includes/footer.php'  ?>