<?php

require '../includes/init.php';


Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require '../includes/header.php'  ?>
<?php if ($article) : ?>
    <article>
        <h2><?= htmlspecialchars($article[0]['title']);  ?></h2>

        <?php if ($article[0]['category_name']) : ?>

            <p>Categories:</p>
            <?php foreach ($article as $a) : ?>
                <?= htmlspecialchars($a['category_name']); ?>
            <?php endforeach; ?>

        <?php endif; ?>

        <p><?= htmlspecialchars($article[0]['content']);  ?></p>
    </article>

    <a href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit Article</a>
    <a href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete Article</a>
    <a href="edit-article-img.php?id=<?= $article[0]['id']; ?>">Edit Article image</a>
<?php else :  ?>
    <p>No Articles Found.</p>


<?php endif; ?>
<?php require '../includes/footer.php'  ?>