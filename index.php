<?php

require 'includes/database.php';

$sql = "SELECT * FROM article ORDER BY id;";

$results = mysqli_query($conn, $sql); // results from given query 

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC); // fetch all rows with given query and assign it to articles;


}

?>

<?php require 'includes/header.php' ?>
<?php if (empty($articles)) : ?>
    <p>No Articles Found.</p>
<?php else :  ?>

    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2>
                        <a href="article.php?id=<?= $article['id'] ?>"><?= $article['title'];  ?></a>
                    </h2>
                    <p><?= $article['content'];  ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>
<?php require 'includes/footer.php'  ?>