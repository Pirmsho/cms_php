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


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if ($article->deleteArticle($conn)) {
        Url::redirect('/admin/index.php');
    }
}

?>

<?php require '../includes/header.php' ?>

<h2>Delete Article</h2>
<form method="POST">
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="article.php?id=<?= $article->id ?>">Cancel</a>
</form>
<?php require '../includes/footer.php' ?>