<?php 

$db_host = "localhost";
$db_name = "cms";
$db_user = "noogai123";
$db_password = "d(z.NNGVZskZh5P3";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name); // connection to db variable

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

$sql = "SELECT * FROM article ORDER BY id;";

$results = mysqli_query($conn, $sql); // results from given query 

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC); // fetch all rows with given query and assign it to articles;

   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>My Blog</h1>
    </header>
    <main>
        <?php if(empty($articles)): ?>
            <p>No Articles Found.</p>
        <?php else:  ?>

        <ul>
            <?php  foreach ($articles as $article): ?>
                <li>
                    <article>
                        <h2><?= $article['title'];  ?></h2>
                        <p><?= $article['content'];  ?></p>
                    </article>
                </li>
            <?php  endforeach; ?>
        </ul>

        <?php endif; ?>
    </main>
</body>
</html>