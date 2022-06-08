<?php

require 'includes/database.php';
require 'includes/article-func.php';
require 'includes/url.php';


$conn = getDB();

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = getArticle($conn, $_GET['id'], 'id');

    if ($article) {
        $id = $article['id'];
    } else {

        die('article not found');
    }
} else {

    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $sql = "DELETE FROM article
        WHERE id = ?"; // placeholders for sql statement


    $statement = mysqli_prepare($conn, $sql); // prepare the sql statement

    if ($statement === false) {
        echo mysqli_error($conn);
    } else {




        mysqli_stmt_bind_param($statement, "i", $id); // bind placeholders to actual values

        if (mysqli_stmt_execute($statement)) {

            redirect("/index.php");
        } else {
            mysqli_stmt_error($statement);
        }
    }
}

?>

<?php require 'includes/header.php' ?>

<h2>Delete Article</h2>
<form method="POST">
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="article.php?id=<?= $article['id'] ?>">Cancel</a>
</form>
<?php require 'includes/footer.php' ?>