<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getSingleArticle($conn, $_GET['id']);

    if (!$article) {

        die('article not found');
    }
} else {

    die("id not supplied, article not found");
}

$category_ids = array_column($article->getCategories($conn), 'id');
$categories = Category::getAllCategories($conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    $category_ids = $_POST['category'] ?? [];


    if ($article->updateArticle($conn)) {

        $article->setCategories($conn, $category_ids);

        Url::redirect("/admin/article.php?id={$article->id}");
    }
}
?>

<?php require '../includes/header.php'  ?>

<h2>Edit Article</h2>

<?php require '../includes/article-form.php'  ?>

<?php require '../includes/footer.php'  ?>