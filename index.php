<?php

require 'classes/Article.php';
require 'classes/Database.php';
require 'includes/auth.php';

session_start();

$db = new Database();
$conn = $db->getConn();


$articles = Article::getAllArticles($conn);



?>

<?php require 'includes/header.php' ?>

<?php if (isLoggedIn()) : ?>
    <a href="/udemy_php/new-article.php">New Article</a>
<?php endif ?>

<?php if (isLoggedIn()) : ?>
    <p>You are logged in!</p> <a href="logout.php">Log out</a>

<?php else : ?>
    <p>You are not logged in! Please log in to add a new article.</p> <a href="login.php">Log in</a>
<?php endif; ?>



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