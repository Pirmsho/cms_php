<?php

require 'includes/init.php';

Auth::requireLogin();

$article = new Article();


$category_ids = [];

$conn = require 'includes/db.php';

$categories = Category::getAllCategories($conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    $category_ids = $_POST['category'] ?? [];


    if ($article->createNewArticle($conn)) {
        Url::redirect("/article.php?id={$article->id}");
    }
}
?>

<?php require 'includes/header.php'  ?>

<h2>New Article</h2>

<?php require 'includes/article-form.php'  ?>

<?php require 'includes/footer.php'  ?>