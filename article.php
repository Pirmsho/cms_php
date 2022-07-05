<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'  ?>
<?php if ($article) : ?>
    <article>

        <h2><?= htmlspecialchars($article[0]['title']);  ?></h2>

        <?php if ($article[0]['category_name']) : ?>

            <p>Categories:</p>
            <?php foreach ($article as $a) : ?>
                <?= htmlspecialchars($a['category_name']); ?>
            <?php endforeach; ?>

        <?php endif; ?>


        <?php if ($article[0]['image_file']) : ?>
            <img src="uploads/<?= $article[0]['image_file'] ?>" alt="article image">
        <?php endif; ?>

        <p><?= htmlspecialchars($article[0]['content']);  ?></p>
    </article>


<?php else :  ?>
    <p>No Articles Found.</p>


<?php endif; ?>
<?php require 'includes/footer.php'  ?>