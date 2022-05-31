<?php

require 'includes/database.php';

$conn = getDB();

if (isset($_GET['id']) && is_numeric($_GET['id'])) { // check if id is number and not null, for safety

    $sql = "SELECT * 
        FROM article 
        WHERE id = " . $_GET['id'];; // superglobal for querystring

    $results = mysqli_query($conn, $sql); // results from given query 

    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $article = mysqli_fetch_assoc($results); // fetch single row with given query and assign it to article;


    }
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

<?php endif; ?>
<?php require 'includes/footer.php'  ?>