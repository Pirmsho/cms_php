<?php

require 'includes/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO article (title, content, published_at)
            VALUES ('" . $_POST['title'] . "','"
        . $_POST['content'] . "','"
        . $_POST['published_at'] . "')";

    $results = mysqli_query($conn, $sql); // results from given query 

    if ($results === false) {
        echo mysqli_error($conn);
    } else {

        $id = mysqli_insert_id($conn);
        echo $id;
    }
}

?>

<?php require 'includes/header.php'  ?>

<h2>New Article</h2>

<form method="POST">
    <div>
        <label for="title">Article Title</label>
        <input type="text" id="title" name="title" placeholder="Article Title">
    </div>

    <div>
        <label for="content">Article Content</label>
        <textarea name="content" id="content" cols="40" rows="4" placeholder="Article Content"></textarea>
    </div>

    <div>
        <label for="published_at">Date</label>
        <input type="datetime-local" id="published_at" name="published_at">
    </div>

    <button>Add Article</button>
</form>

<?php require 'includes/footer.php'  ?>