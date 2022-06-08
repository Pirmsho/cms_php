<?php

require 'includes/database.php';
require 'includes/article-func.php';

$conn = getDB();

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = getArticle($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'  ?>
<?php if ($article === null) : ?>
    <p>No Articles Found.</p>
<?php else :  ?>

    <article>
        <h2><?= htmlspecialchars($article['title']);  ?></h2>
        <p><?= htmlspecialchars($article['content']);  ?></p>
    </article>

    <a href="edit-article.php?id=<?= $article['id']; ?>">Edit Article</a>
    <a href="delete-article.php?id=<?= $article['id']; ?>">Delete Article</a>

<?php endif; ?>
<?php require 'includes/footer.php'  ?>