<?php

require 'includes/database.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["title"] == "") {
        $errors[] = "Title is required!";
    }

    if ($_POST["content"] == "") {
        $errors[] = "Content is required!";
    }


    if (empty($errors)) {



        $conn = getDB();

        $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?,?,?)"; // placeholders for sql statement


        $statement = mysqli_prepare($conn, $sql); // prepare the sql statement

        if ($statement === false) {
            echo mysqli_error($conn);
        } else {

            if ($_POST["published_at"] == "") {
                $_POST["published_at"] = null;
            }


            mysqli_stmt_bind_param($statement, "sss", $_POST["title"], $_POST["content"], $_POST["published_at"]); // bind placeholders to actual values

            if (mysqli_stmt_execute($statement)) {
                $id = mysqli_insert_id($conn);
                if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != 'off') {
                    $protocol = "https";
                } else {
                    $protocol = "http";
                }

                header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/Udemy_Php" . "/article.php?id=$id");
            } else {
                mysqli_stmt_error($statement);
            }
        }
    }
}
?>

<?php require 'includes/header.php'  ?>

<h2>New Article</h2>

<form method="POST">
    <?php if (!empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) :  ?>
                <li>
                    <?= $error  ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
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