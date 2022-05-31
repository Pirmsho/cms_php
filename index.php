<?php

require 'includes/database.php';

$conn = getDB();

$sql = "SELECT * FROM article ORDER BY id;";

$results = mysqli_query($conn, $sql); // results from given query 

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC); // fetch all rows with given query and assign it to articles;


}

?>

<?php require 'includes/header.php' ?>
<a href="/udemy_php/new-article.php">New Article</a>
<?php if (empty($articles)) : ?>
    <p>No Articles Found.</p>
<?php else :  ?>

    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2>
                        <a href="article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']);  ?></a>
                    </h2>
                    <p><?= htmlspecialchars($article['content']);  ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>
<?php require 'includes/footer.php'  ?>