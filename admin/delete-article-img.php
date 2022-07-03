<?php



require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getSingleArticle($conn, $_GET['id']);

    if (!$article) {

        die('article not found');
    }
} else {

    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {





    $previous_image = $article->image_file;

    if ($article->setImageFile($conn, null)) {

        if ($previous_image) {
            unlink("../uploads/$previous_image");
        }

        URL::redirect("/admin/article.php?id={$article->id}");
    }
}

?>

<?php require '../includes/header.php'  ?>

<h2>delete Article image</h2>

<form method="post" enctype="multipart/form-data">
    <h4>Are you sure?</h4>
    <button>Delete</button>
    <a href="edit-article-img.php?id=<?= $article->id ?>">Cancel</a>
</form>

<?php require '../includes/footer.php'  ?>