<?php

require '../includes/init.php';


Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getSingleArticle($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require '../includes/header.php'  ?>
<?php if ($article) : ?>
    <article>
        <h2><?= htmlspecialchars($article->title);  ?></h2>
        <p><?= htmlspecialchars($article->content);  ?></p>
    </article>

    <a href="edit-article.php?id=<?= $article->id; ?>">Edit Article</a>
    <a href="delete-article.php?id=<?= $article->id; ?>">Delete Article</a>
    <a href="edit-article-img.php?id=<?= $article->id; ?>">Edit Article image</a>
<?php else :  ?>
    <p>No Articles Found.</p>


<?php endif; ?>
<?php require '../includes/footer.php'  ?>