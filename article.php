<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getSingleArticle($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'  ?>
<?php if ($article) : ?>
    <article>
        <h2><?= htmlspecialchars($article->title);  ?></h2>

        <?php if ($article->image_file) : ?>
            <img src="uploads/<?= $article->image_file ?>" alt="article image">
        <?php endif; ?>

        <p><?= htmlspecialchars($article->content);  ?></p>
    </article>


<?php else :  ?>
    <p>No Articles Found.</p>


<?php endif; ?>
<?php require 'includes/footer.php'  ?>